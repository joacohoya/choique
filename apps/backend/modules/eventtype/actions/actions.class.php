<?php 
/*
 * Choique CMS - A Content Management System.
 * Copyright (C) 2012 CeSPI - UNLP <desarrollo@cespi.unlp.edu.ar>
 * 
 * This file is part of Choique CMS.
 * 
 * Choique CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License v2.0 as published by
 * the Free Software Foundation.
 * 
 * Choique CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Choique CMS.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
 */ ?>
<?php

/**
 * eventtype actions.
 *
 * @package    new_cms
 * @subpackage eventtype
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class eventtypeActions extends autoeventtypeActions
{
  public function executeDelete()
  {
    $this->eventtype = $this->getEventTypeOrCreate();
    if ($this->eventtype->canDelete())
    {
      try
      {
        $this->eventtype->delete();
        
      }
      catch (PropelException $e)
      {
        $this->getRequest()->setError('delete', 'El tipo de evento ' . $this->eventtype->getTitle() .' no se puede borrar, debido a que esta referenciado en un evento ');
      }
      $this->setFlash('notice', 'The selected element has been successfully deleted'); 
    }
    else
    {
      $this->getRequest()->setError('delete', 'El tipo de evento ' . $this->eventtype->getTitle() .' no se puede borrar, debido a que esta referenciado en un evento ');
    }
    return $this->forward('eventtype','list');
  }
}