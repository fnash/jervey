<?php

defined('_JEXEC') or die('Restricted access');

function jerveyBuildRoute( &$query )
{
       $segments = array();
       if (isset($query['controller']))
       {
                $segments[] = $query['controller'];
                unset( $query['controller'] );
       }
       if (isset($query['id']))
       {
                $segments[] = $query['id'];
                unset( $query['id'] );
       };
       return $segments;
}

function jerveyParseRoute( $segments )
{
       $vars = array();
       switch($segments[0])
       {
               case 'surveys':
                       $vars['controller'] = 'surveys';
                       break;
               case 'survey':
                       $vars['controller'] = 'survey';
                       $id = explode( ':', $segments[1] );
                       $vars['id'] = (int) $id[0];
                       break;
       }
       return $vars;
}
