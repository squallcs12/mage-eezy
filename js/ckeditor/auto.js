/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

window.CKEDITOR_BASEPATH = BASE_URL + 'js/ckeditor/';
jQuery(function($){
    $("textarea.wysiwyg").each(function(){
        CKEDITOR.replace(this);
    })
});