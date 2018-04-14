<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>File Manager</title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/elfinder.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/theme.css') ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<style>
		.box .ui.content {
			padding : 0 !important;
		}

		body {
			overflow : hidden !important;
			margin   : 0;
			padding  : 0;
		}

		.ui-widget {
			font-family : 'Open Sans', 'Helvetica Neue', Arial, Helvetica, sans-serif !important;
		}

		.ui-widget input,
		.ui-widget select,
		.ui-widget textarea,
		.ui-widget button {
			font-family : 'Open Sans', 'Helvetica Neue', Arial, Helvetica, sans-serif !important;
		}

		.elfinder .elfinder-navbar {
			font-size  : 13px;
			overflow-x : hidden;
		}

		.elfinder-button-icon, .elfinder-tree .elfinder-navbar-root-local .elfinder-navbar-icon {
			height      : 100%;
			width       : 100%;
			display     : block;
			background  : none;
			font-family : "FontAwesome";
			font-size   : 18px;
		}

		.elfinder-button-icon-back:before {
			content : "\f100";
		}

		.elfinder-button-icon-forward:before {
			content : "\f101";
		}

		.elfinder-button-icon-reload:before {
			content : "\f021";
		}

		.elfinder-button-icon-home:before {
			content : "\f015";
		}

		.elfinder-button-icon-up:before {
			content : "\f102";
		}

		.elfinder-button-icon-mkdir:before {
			content : "\f115";
		}

		.elfinder-button-icon-mkfile:before {
			content : "\f0f6";
		}

		.elfinder-button-icon-upload:before {
			content : "\f0ee";
		}

		.elfinder-button-icon-download:before {
			content : "\f0ed";
		}

		.elfinder-button-icon-copy:before {
			content : "\f0c5";
		}

		.elfinder-button-icon-cut:before {
			content : "\f0c4";
		}

		.elfinder-button-icon-paste:before {
			content : "\f0ea";
		}

		.elfinder-button-icon-rm:before {
			content : "\f014";
		}

		.elfinder-button-icon-duplicate:before {
			content : "\f079";
		}

		.elfinder-button-icon-rename:before {
			content : "\f040";
		}

		.elfinder-button-icon-edit:before {
			content : "\f044";
		}

		.elfinder-button-icon-resize:before {
			content : "\f0b2";
		}

		.elfinder-button-icon-selectedareaadd:before {
			content : "\f05d";
		}

		.elfinder-button-icon-multipleareaadd:before {
			content : "\f03e";
		}

		.elfinder-tree .elfinder-navbar-root-local {
			text-transform : capitalize;
		}

		.elfinder-tree .elfinder-navbar-root-local .elfinder-navbar-icon {
			font-size  : 14px;
			margin-top : -8px
		}

		.elfinder-tree .elfinder-navbar-root-local .elfinder-navbar-icon:before {
			content : "\f0a0";
		}

		.ui-widget-header.elfinder-toolbar {
			font-weight             : 600;
			color                   : #333;
			background              : #eee;
			position                : relative;
			z-index                 : 4;
			font-family             : Arial, Helvetica, sans-serif;
			-webkit-box-sizing      : border-box;
			-moz-box-sizing         : border-box;
			box-sizing              : border-box;
			user-select             : none;
			-o-user-select          : none;
			-moz-user-select        : none;
			-khtml-user-select      : none;
			-webkit-user-select     : none;
			-ms-user-select         : none;
			padding                 : 0;
			border-radius           : 0;
			-moz-border-radius      : 0;
			-webkit-border-radius   : 0;
			-moz-background-clip    : padding;
			-webkit-background-clip : padding-box;
			background-clip         : padding-box;
			-webkit-box-shadow      : 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			-moz-box-shadow         : 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			box-shadow              : 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			text-align              : left;
			border                  : 0px;
		}

		.ui-widget-content.elfinder-buttonset, .ui-widget-content.elfinder-toolbar-button-separator {
			border : 0;
		}

		.elfinder-buttonset {
			margin                : 0;
			float                 : none;
			background            : none;
			padding               : 0;
			-moz-border-radius    : 4px;
			-webkit-border-radius : 4px;
			border-radius         : 0;
		}

		.elfinder .elfinder-button {
			padding    : 8px;
			width      : 30px;
			height     : 100%;
			text-align : center;
		}

		.elfinder .elfinder-button-search {
			width   : 202px;
			padding : 0;
		}

		.ui-state-default.elfinder-button {
			background : none;
			border     : none;
		}

		.elfinder-button:first-child, .elfinder-button:last-child {
			border-radius : 0
		}

		.elfinder-button:hover {
			background : #f7f9fe;
			transition : background .1s ease, box-shadow .1s ease, color .1s ease;
		}

		.elfinder-button:hover .elfinder-button-search {
			background : none;
		}

		.elfinder-cwd-view-icons .elfinder-cwd-filename, .elfinder-cwd-view-list td, .elfinder-contextmenu .elfinder-contextmenu-item span {
			font-size : 13px;
		}

		.elfinder-contextmenu-ltr .elfinder-contextmenu-icon {
			color : #111;
		}

		.elfinder-contextmenu .ui-state-hover {
			background : #ebebeb;
			color      : #111;
		}

		.elfinder-contextmenu, .elfinder-contextmenu-sub {
			padding : 0;
		}

		.ui-corner-all {
			border-radius : 0 !important;
		}

		.ui-widget-content.elfinder {
			border : none;
		}

		.elfinder-cwd-view-icons .elfinder-cwd-file.ui-selected .elfinder-cwd-filename.ui-state-hover {
			color : #fff;
		}

		.elfinder-cwd-view-icons .elfinder-cwd-file .elfinder-cwd-filename.ui-state-hover {
			color : #333;
		}

		.ui-corner-bottom.elfinder-statusbar {
			border-radius : 0;
		}
	</style>

	<script src="<?= assets('js/admin.min.js') ?>"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="<?= asset($dir . '/js/elfinder.min.js') ?>"></script>
	<script src="<?= asset($dir . "/js/i18n/elfinder.$locale.js") ?>"></script>
	<script type="text/javascript" charset="utf-8">
		$().ready(function () {
			var app = parent.App;

			if (app) {

				var setting = app.modal.filemanagerSettting;

				if (setting.type == 'one') {
					selectedAreaAdd(setting)
				}

				if (setting.type == 'multiple') {
					multipleAreaAdd(setting);
				}

				if (setting.type == 'file') {
					//selectedAreaFileAdd(setting)
				}
			}

			var elfinder = $('#elfinder').elfinder({
				lang: '<?= $locale ?>',
				url: '<?= url(route_action('related')) ?>',
				urlUpload: '<?= url(route_action('connect')) ?>',
				customData: {
					_token: '<?= csrf_token() ?>'
				},
				resizable: false,
				rememberLastDir: true,
				useBrowserHistory: true,
				showFiles: 30,
				showThreshold: 50,
				loadTmbs: 5,
				debug: [
					'error',
					'warning',
					'event-destroy'
				],
				onlyMimes: [
					'image',
					'application/pdf',
					'application/vnd.ms-excel',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
				],
				height: 500,
				uiOptions: {
					toolbar: [
						[
							'back',
							'forward',
							'reload',
							'home',
							'up',
							'mkdir',
							'upload',
							'download',
							'copy',
							'cut',
							'paste',
							'rm',
							'duplicate',
							'rename',
							'resize'
						]
						/*
						 [
						 'search',
						 ]
						 */
					]
				},
				contextmenu: {
					files: [
						'selectedareaadd',
						'multipleareaadd',
						'|',
						'open',
						'quicklook',
						'|',
						'download',
						'|',
						'copy',
						'cut',
						'paste',
						'duplicate',
						'|',
						'rm',
						'|',
						'edit',
						'rename',
						'resize'
					]
				},
				getFileCallback: function (file) { // editor callback
					FileBrowserDialogue.mySubmit('/storage/' + file.path.replace(/\\/g, "/"));
				},
			});
		});

		var FileBrowserDialogue = {
			init: function () {
				// Here goes your code for setting your custom things onLoad.
			},
			mySubmit: function (URL) {
				// pass selected file path to TinyMCE
				parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

				// close popup window
				parent.tinymce.activeEditor.windowManager.close();
			}
		}

		function notThreeLoad() {
			if ($('.elfinder-navbar-root span.elfinder-navbar-spinner').size()) {
				alert("<?= trans('admin/filemanager/filemanager.loadingDirectories') ?>");
				return true;
			}
		}

		function selectedAreaAdd(setting) {

			elFinder.prototype._options.commands.push('selectedareaadd');
			elFinder.prototype._options.contextmenu.files.push('selectedareaadd');
			elFinder.prototype.i18.tr.messages['cmdselectedareaadd'] = "Seçili Alana Ekle";
			elFinder.prototype.commands.selectedareaadd              = function () {
				this.exec     = function (hashes) {

					if (notThreeLoad()) {
						return false;
					}

					var fm       = this.fm;
					var loadPath = fm.path(this.files(hashes)[0].hash);

					if (loadPath.slice(0, 7) == 'storage') {
						var path = fm.path(this.files(hashes)[0].hash);
					} else {
						var path = 'storage/' + fm.path(this.files(hashes)[0].hash);
					}

					parent.$(setting.id).find('img').attr('src', path);
					parent.$(setting.id).find('input').val(path);
					parent.$('#modalFileManager').modal('hide');

					return false;
				}
				this.getstate = function () {
					var sel = this.files(sel),
					    cnt = sel.length;
					return !this._disabled && cnt ? 0 : -1;
				}
			}
		}

		function multipleAreaAdd(setting) {

			elFinder.prototype._options.commands.push('multipleareaadd');
			elFinder.prototype._options.contextmenu.files.push('multipleareaadd');
			elFinder.prototype.i18.tr.messages['cmdmultipleareaadd'] = "Resim Listesine Ekle";
			elFinder.prototype.commands.multipleareaadd              = function () {
				if (notThreeLoad()) {
					return false;
				}

				this.exec = function (hashes) {

					if (notThreeLoad()) {
						return false;
					}

					var fm     = this.fm;
					var params = [];

					$.each(this.files(hashes), function (key, value) {

						params[key] = 'storage/' + fm.path(value.hash) + '/-/' + parent.App.modal.filemanagerSettting.row;

						parent.App.modal.filemanagerSettting.row++;
					});

					var query = params.join(',');

					parent.App.dimmer.page();

					$.get(setting.uri, {
						type: 'filemanager',
						q: query
					}, function (response) {
						parent.$(setting.id).append(response);
						parent.App.dimmer.remove();
					});

					parent.$('#modalFileManager').modal('hide');

					return false;
				}

				this.getstate = function () {
					var sel = this.files(sel),
					    cnt = sel.length;
					return !this._disabled && cnt ? 0 : -1;
				}
			}
		}
	</script>
</head>
<body>
<div id="elfinder"></div>
</body>
</html>
