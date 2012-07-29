(function() {  
    tinymce.create('tinymce.plugins.his', {  
        init : function(ed, url) {  
            ed.addButton('his', {  
                title : 'Hover Image Switcher',  
                image : url+'/his.png',  
                onclick : function() {  
                     ed.selection.setContent('[his]' + ed.selection.getContent() + '[/his]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('his', tinymce.plugins.his);  
})(); 