<?php
/*
 * This file is part of FacturaScripts
 * Copyright (C) 2013-2017  Carlos Garcia Gomez  neorazorx@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'base/fs_cache.php';
require_once 'base/fs_db2.php';
require_once 'base/fs_functions.php';
require_once 'base/fs_default_items.php';

/**
 * La clase de la que heredan todos los modelos, conecta a la base de datos,
 * comprueba la estructura de la tabla y de ser necesario la crea o adapta.
 * 
 * @author Carlos García Gómez <neorazorx@gmail.com>
 */
abstract class fs_model
{
   /**
    * Proporciona acceso directo a la base de datos.
    * Implementa la clase fs_mysql o fs_postgresql.
    * @var fs_db2
    */
   protected $db;
   
   /**
    * Nombre de la tabla en la base de datos.
    * @var type 
    */
   protected $table_name;
   
   /**
    * Directorio donde se encuentra el directorio table con
    * el XML con la estructura de la tabla.
    * @var type 
    */
   protected $base_dir;
   
   /**
    * Permite conectar e interactuar con memcache.
    * @var fs_cache
    */
   protected $cache;
   
   /**
    * Clase que se utiliza para definir algunos valores por defecto:
    * codejercicio, codserie, coddivisa, etc...
    * @var fs_default_items
    */
   protected $default_items;
   
   private static $checked_tables;
   private static $errors;
   private static $messages;

   /**
    * 
    * @param type $name nombre de la tabla de la base de datos.
    */
   public function __construct($name = '')
   {
      $this->cache = new fs_cache();
      $this->db = new fs_db2();
      $this->table_name = $name;
      
      /// buscamos el xml de la tabla en los plugins
      $this->base_dir = '';
      foreach($GLOBALS['plugins'] as $plugin)
      {
         if( file_exists('plugins/'.$plugin.'/model/table/'.$name.'.xml') )
         {
            $this->base_dir = 'plugins/'.$plugin.'/';
            break;
         }
      }
      
      $this->default_items = new fs_default_items();
      
      if( !self::$errors )
      {
         self::$errors = array();
      }
      
      if( !self::$messages )
      {
         self::$messages = array();
      }
      
      if( !self::$checked_tables )
      {
         self::$checked_tables = $this->cache->get_array('fs_checked_tables');
         if(self::$checked_tables)
         {
            /// nos aseguramos de que existan todas las tablas que se suponen comprobadas
            $tables = $this->db->list_tables();
            foreach(self::$checked_tables as $ct)
            {
               if( !$this->db->table_exists($ct, $tables) )
               {
                  $this->clean_checked_tables();
                  break;
               }
            }
         }
      }
      
      if($name != '')
      {
         if( !in_array($name, self::$checked_tables) )
         {
            if( $this->check_table($name) )
            {
               self::$checked_tables[] = $name;
               $this->cache->set('fs_checked_tables', self::$checked_tables, 5400);
            }
         }
      }
   }
   
   /**
    * Limpia la lista de tablas comprobadas.
    */
   protected function clean_checked_tables()
   {
      self::$checked_tables = array();
      $this->cache->delete('fs_checked_tables');
   }
   
   /**
    * Muestra al usuario un mensaje de error
    * @param type $msg mensaje de error
    */
   protected function new_error_msg($msg = FALSE)
   {
      if($msg)
      {
         self::$errors[] = $msg;
      }
   }
   
   /**
    * Devuelve la lista de mensajes de error de los modelos.
    * @return type lista de errores.
    */
   public function get_errors()
   {
      return self::$errors;
   }
   
   /**
    * Vacía la lista de errores de los modelos.
    */
   public function clean_errors()
   {
      self::$errors = array();
   }
   
   /**
    * Muestra al usuario un mensaje.
    * @param type $msg
    */
   protected function new_message($msg = FALSE)
   {
      if($msg)
      {
         self::$messages[] = $msg;
      }
   }
   
   /**
    * Devuelve la lista de mensajes de los modelos.
    * @return type
    */
   public function get_messages()
   {
      return self::$messages;
   }
   
   /**
    * Vacía la lista de mensajes de los modelos.
    */
   public function clean_messages()
   {
      self::$messages = array();
   }
   
   /**
    * Esta función es llamada al crear una tabla.
    * Permite insertar valores en la tabla.
    */
   abstract protected function install();
   
   /**
    * Esta función devuelve TRUE si los datos del objeto se encuentran
    * en la base de datos.
    */
   abstract public function exists();
   
   /**
    * Esta función sirve tanto para insertar como para actualizar
    * los datos del objeto en la base de datos.
    */
   abstract public function save();
   
   /**
    * Esta función sirve para eliminar los datos del objeto de la base de datos
    */
   abstract public function delete();
   
   /**
    * Escapa las comillas de una cadena de texto.
    * @param type $s cadena de texto a escapar
    * @return type cadena de texto resultante
    */
   protected function escape_string($s = '')
   {
      return $this->db->escape_string($s);
   }
   
   /**
    * Transforma una variable en una cadena de texto válida para ser
    * utilizada en una consulta SQL.
    * @param type $v
    * @return string
    */
   public function var2str($v)
   {
      if( is_null($v) )
      {
         return 'NULL';
      }
      else if( is_bool($v) )
      {
         if($v)
         {
            return 'TRUE';
         }
         else
            return 'FALSE';
      }
      else if( preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/i', $v) ) /// es una fecha
      {
         return "'".Date($this->db->date_style(), strtotime($v))."'";
      }
      else if( preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})$/i', $v) ) /// es una fecha+hora
      {
         return "'".Date($this->db->date_style().' H:i:s', strtotime($v))."'";
      }
      else
         return "'" . $this->db->escape_string($v) . "'";
   }
   
   /**
    * Convierte una variable con contenido binario a texto.
    * Lo hace en base64.
    * @param type $v
    * @return string
    */
   protected function bin2str($v)
   {
      if( is_null($v) )
      {
         return 'NULL';
      }
      else
         return "'".base64_encode($v)."'";
   }
   
   /**
    * Convierte un texto a binario.
    * Lo hace con base64.
    * @param type $v
    * @return type
    */
   protected function str2bin($v)
   {
      if( is_null($v) )
      {
         return NULL;
      }
      else
         return base64_decode($v);
   }
   
   /**
    * PostgreSQL guarda los valores TRUE como 't', MySQL como 1.
    * Esta función devuelve TRUE si el valor se corresponde con
    * alguno de los anteriores.
    * @param type $v
    * @return type
    */
   public function str2bool($v)
   {
      return ($v == 't' OR $v == '1');
   }
   
   /**
    * Devuelve el valor entero de la variable $s,
    * o NULL si es NULL. La función intval() del php devuelve 0 si es NULL.
    * @param type $s
    * @return type
    */
   public function intval($s)
   {
      if( is_null($s) )
      {
         return NULL;
      }
      else
         return intval($s);
   }
   
   /**
    * Compara dos números en coma flotante con una precisión de $precision,
    * devuelve TRUE si son iguales, FALSE en caso contrario.
    */
   public function floatcmp($f1, $f2, $precision = 10, $round = FALSE)
   {
      if( $round OR !function_exists('bccomp') )
      {
         return( abs($f1-$f2) < 6/pow(10,$precision+1) );
      }
      else
         return( bccomp( (string)$f1, (string)$f2, $precision ) == 0 );
   }
   
   /**
    * Devuelve un array() con todas las fechas entre $first y $last.
    * @param type $first
    * @param type $last
    * @param type $step
    * @param type $format
    * @return type
    */
   protected function date_range($first, $last, $step = '+1 day', $format = 'd-m-Y' )
   {
      $dates = array();
      $current = strtotime($first);
      $last = strtotime($last);
      
      while( $current <= $last )
      {
         $dates[] = date($format, $current);
         $current = strtotime($step, $current);
      }
      
      return $dates;
   }
   
   /**
    * Esta función convierte:
    * < en &lt;
    * > en &gt;
    * " en &quot;
    * ' en &#39;
    * 
    * No tengas la tentación de sustiturla por htmlentities o htmlspecialshars
    * porque te encontrarás con muchas sorpresas desagradables.
    */
   public function no_html($t)
   {
      $newt = str_replace(
              array('<','>','"',"'"),
              array('&lt;','&gt;','&quot;','&#39;'),
              $t
      );
      
      return trim($newt);
   }
   
   /**
    * Devuelve una cadena de texto aleatorio de longitud $length
    * @param type $length
    * @return type
    */
   protected function random_string($length = 10)
   {
      return mb_substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
   }
   
   /**
    * Comprueba y actualiza la estructura de la tabla si es necesario
    * @param type $table_name
    * @return boolean
    */
   protected function check_table($table_name)
   {
      $done = TRUE;
      $consulta = '';
      $xml_columnas = array();
      $xml_restricciones = array();
      
      if( $this->get_xml_table($table_name, $xml_columnas, $xml_restricciones) )
      {
         if( $this->db->table_exists($table_name) )
         {
            if( !$this->db->check_table_aux($table_name) )
            {
               $this->new_error_msg('Error al convertir la tabla a InnoDB.');
            }
            
            /// eliminamos restricciones
            $restricciones = $this->db->get_constraints($table_name);
            $consulta2 = $this->db->compare_constraints($table_name, $xml_restricciones, $restricciones, TRUE);
            if($consulta2 != '')
            {
               if( !$this->db->exec($consulta2) )
               {
                  $this->new_error_msg('Error al comprobar la tabla '.$table_name);
               }
            }
            
            /// comparamos las columnas
            $columnas = $this->db->get_columns($table_name);
            $consulta .= $this->db->compare_columns($table_name, $xml_columnas, $columnas);
            
            /// comparamos las restricciones
            $restricciones = $this->db->get_constraints($table_name);
            $consulta .= $this->db->compare_constraints($table_name, $xml_restricciones, $restricciones);
         }
         else
         {
            /// generamos el sql para crear la tabla
            $consulta .= $this->db->generate_table($table_name, $xml_columnas, $xml_restricciones);
            $consulta .= $this->install();
         }
         
         if($consulta != '')
         {
            if( !$this->db->exec($consulta) )
            {
               $this->new_error_msg('Error al comprobar la tabla '.$table_name);
               $done = FALSE;
            }
         }
      }
      else
      {
         $this->new_error_msg('Error con el xml.');
         $done = FALSE;
      }
      
      return $done;
   }
   
   /**
    * Obtiene las columnas y restricciones del fichero xml para una tabla
    * @param type $table_name
    * @param type $columnas
    * @param type $restricciones
    * @return boolean
    */
   protected function get_xml_table($table_name, &$columnas, &$restricciones)
   {
      $retorno = FALSE;
      $filename = $this->base_dir.'model/table/'.$table_name.'.xml';
      
      if( file_exists($filename) )
      {
         $xml = simplexml_load_string( file_get_contents('./'.$filename, FILE_USE_INCLUDE_PATH) );
         if($xml)
         {
            if($xml->columna)
            {
               $i = 0;
               foreach($xml->columna as $col)
               {
                  $columnas[$i]['nombre'] = $col->nombre;
                  $columnas[$i]['tipo'] = $col->tipo;
                  
                  $columnas[$i]['nulo'] = 'YES';
                  if($col->nulo)
                  {
                     if( strtolower($col->nulo) == 'no')
                     {
                        $columnas[$i]['nulo'] = 'NO';
                     }
                  }
                  
                  if($col->defecto == '')
                  {
                     $columnas[$i]['defecto'] = NULL;
                  }
                  else
                     $columnas[$i]['defecto'] = $col->defecto;
                  
                  $i++;
               }
               
               /// debe de haber columnas, sino es un fallo
               $retorno = TRUE;
            }
            
            if($xml->restriccion)
            {
               $i = 0;
               foreach($xml->restriccion as $col)
               {
                  $restricciones[$i]['nombre'] = $col->nombre;
                  $restricciones[$i]['consulta'] = $col->consulta;
                  $i++;
               }
            }
         }
         else
            $this->new_error_msg('Error al leer el archivo '.$filename);
      }
      else
         $this->new_error_msg('Archivo '.$filename.' no encontrado.');
      
      return $retorno;
   }
}
