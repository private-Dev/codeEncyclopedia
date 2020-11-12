# codeEncyclopedia

create database 

dump sql file in dump folder

make copy constant.class.example.php to constant.class.php

change dns refs

<hr>

## TODO MAP

#### SECURITY
 - [x] Login page
 - [x] redirection security on every pages
 - [x] deconnection feature
 - [x] redirection to login page security on not allowed access page

#### DESIGN
 - [x] find some design , logo  
 - [ ] change list design

 #### ADMIN
 - [x] create front view
 - [x] list theme
 - [x] draggable list theme item (not sure if it's revelant) 
 - [x] draggable list blocknote item (not sure if it's revelant) 
 - [x] draggable list note item (not sure if it's revelant) 
 
 #### MARKDOWN
 - [x] create class tiny markdown for a internal use
 - [ ] add img handling tag

 #### PROCESS
 - [x] jquery create theme injection form on create note page
 - [x] jquery create blocknote injection form on create note page
 - [x] ajax persist id on theme and blocknote id (select html) on create note page  
 - [x] save new note on front revamp interface 
 - [x] add tab preview note and write note on addNote.php
 - [x] add btn helper code insert on textarea note
 - [ ] add btn edit mode for a note  



 
 #### FEATURE EASY USE (user friendly)
 - [ ] drag and drop image on textarea (auto download img then git a formated link usable on page
 - [ ] search bar on left menu (search)
 - [ ] search bar on top menu (search entire db)
 
<hr>

## short demo  : feature edit/preview Note (in progress ) 

![demo-preview-note](https://user-images.githubusercontent.com/52592449/98852303-c58c6800-2457-11eb-8d7e-9e7a510b671e.gif)

## login

![FireShot Capture 021 - CODE REMINDER ENCYCLOPEDIA - localhost](https://user-images.githubusercontent.com/52592449/97796832-1fe72680-1c17-11eb-9b91-a30890385774.png)

## admin

![FireShot Capture 024 -  - localhost](https://user-images.githubusercontent.com/52592449/97774020-d2a28080-1b54-11eb-9399-94a64a07b7be.png)

## front

![01](https://user-images.githubusercontent.com/52592449/97773915-0f21ac80-1b54-11eb-9b9d-46cab6a9023a.png)


## ParseClassedown

/** 
*
*
* ParseClassedown
* 
* a tiny markDown that handle a few selectors 
* we can add specific class to selector to match a custom design with css    
*
* 24/10/2020
* (c) jpb (rick)
* http://guitaresphere.com
* 
* For the full license information, view the LICENSE file that was distributed
* with this source code.
*
*
 * 
 *  v1.0.0 
 * 
 *  One line or multiLine per markdown
 * 
 *  each line must start at beginning of line 
 *      ex : # my text wrong
 *      ex :# my text good  
 * 
 *  each line must have a space between markdown tag and text to be interpreted.
 *      ex :#wrong  
 *      ex :# good
 *  
 * 
 * class can be added on fly  
 * 
 *   first method 
 *    implicit 
 *     the descriptor tag have some personnal class linked to markdown tag 
 *      :: on <p> give class="tip imp"
 *      && on <p> give class="tip warning"
 *      you have to declare on proper css file and include in desired html/php file
 * 
 *   seconde method
 *      explicit 
 *      at the end of line , you can add the special tag {{}}  and 
 *      put some name class in it
 *      you can put un unlimited numbers of class. they have to be separated by space 
 *      ex :# my text {{ MyClass MyOtherClass }}
 * 
 *  multiLine  selectors
 * 
 *  ! , & , !! , &&  are multiline selectors
 *  they have to follow the monoline selector rule for starting point. 
 *  ex :! mytext good
 *  ex : ! mytext wrong
 * 
 *  each multiLine tag must be endded by his endtag  !/ , &/ , !!/ , &&/
 *  can be placed on  a text line or alone in separate line
 * 
 *  ex:! my text !/
 * 
 *  ex:! 
 *      my text !/
 * 
 *  ex:! 
 *      my text 
 *     !/
 * 
 *  WARNING :  multiLine and class Tag declaration  
 *  you have to always place class on first line of your multilineTag
 *  if you create a multiline tag with class contained on one line, you have to close tagMultine before tag class
 * 
 *  ex:! mytext !/ {{myclass myotherclass}}   
 * 
 *  ex: ! imp 1 {{tip imp}}
 *      2 imp text with explicit class
 *      3 imp text with explicit class
 *      !/
 * 
 */

