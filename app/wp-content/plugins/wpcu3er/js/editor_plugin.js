(function() {
	
	var CU3ER = {
	
		init: function() {
			// call all slideshows //
		},
		
		insertSlideShow: function(id) {
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, "<div class='embedCU3ER' id='CU3ER"+ id +"'>[CU3ER slider='" + id + "']</div>");
			/*jQuery.ajax({
				url: '../wp-content/plugins/wpcu3er/php/ajaxReq.php?act=getTinyData&id=' + id,
				dataType: 'json',
				success: function(response) {
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, "<div class='embedCU3ER' id='CU3ER"+ id +"'>[CU3ER slider='" + id + "']</div>");
				}
			});*/
		},
		
		selectSlideShow: function() {
			tb_show('', '../wp-content/plugins/wpcu3er/php/ajaxReq.php?act=list&KeepThis=true');
			jQuery('#TB_iframeContent').width('100%');
			thickDimensions();
		},
		
		createSlideShow: function() {
			window.location = 'admin.php?page=CU3ERAddNew';
		}
		
	};
	
	thickDimensions = function() {
		var tbWindow = jQuery('#TB_window');
		jQuery(tbWindow).width('500px').height('600px');
		jQuery("#TB_ajaxContent").width('95%').height('80%');
	};
	
	jQuery('.mdpc_select').live('click', function(e) {
		e.preventDefault();
		CU3ER.insertSlideShow(jQuery(this).attr('rel'));
		tb_remove();
		return false;
	});
	
	jQuery.ajax({
		url: '../wp-content/plugins/wpcu3er/php/ajaxReq.php?act=slideshows',
		dataType: 'json',
		success: function(response) {
			CU3ER.slideshows = response;
		}
	});
	
	tinymce.create('tinymce.plugins.wpCU3ER', {
		init: function(ed, url) {
			ed.onNodeChange.add(function(ed, cm, n) {
				if(n.getAttribute('class') == 'embedCU3ER') {
					tinyMCE.activeEditor.selection.select(n);
					ed.plugins.contextmenu.onContextMenu.add(function(th, menu, event) {
						menu.removeAll();
						menu.add({
							title : 'Edit CU3ER',
							onclick: function() {
								var txt = jQuery(n).html();
								var matches = txt.match(/\[.*?='(.*?)'\]/);
								window.location = 'admin.php?page=CU3ERManageAll&id=' + matches[1];
							}
						});
						menu.add({
							title : 'Replace CU3ER',
							onclick: function() {
								tinyMCE.activeEditor.selection.select(n);
								CU3ER.selectSlideShow();
							}
						});
						menu.add({
							title : 'Remove CU3ER',
							onclick: function() {
								tinyMCE.activeEditor.selection.select(n);
								tinyMCE.activeEditor.selection.setContent('');
							}
						});
					});
				}
			});
		},
		
		createControl: function(n, cm) {
			switch (n) {
				case 'wpCU3ER':
					var c = cm.createSplitButton('wpCU3ER', {
						title : 'Insert CU3ER',
						image : '../wp-content/plugins/wpcu3er/img/cu3er_tinymce.png',
						onclick : function() {
							c.showMenu();
						}
					});
					c.onRenderMenu.add(function(c,m) {
						m.add({title : 'Create new', onclick : CU3ER.createSlideShow});
						if(CU3ER.slideshows != null) {
							m.add({title : 'Insert CU3ER into post', onclick : CU3ER.selectSlideShow});
						}
					});
				return c;
			}
			return null;
		},
	});
	
	tinymce.PluginManager.add('wpCU3ER', tinymce.plugins.wpCU3ER);
})()
