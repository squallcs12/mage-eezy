/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function($){
    $("textarea.wysiwyg").each(function(){
        CKEDITOR.replace(this);
    })
});