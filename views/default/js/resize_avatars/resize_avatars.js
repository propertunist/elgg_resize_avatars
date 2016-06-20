define(function(require) {
	var $ = require('jquery');
	var elgg = require('elgg');

	resizethumbnails_init = function() {
		$("#resize_avatars-resize-thumbnails").on('click', resizethumbnails_submit);

		$(document).ready(function()
		{
				$('#icon_table input[type=checkbox]').each(function(){
						if ($(this).is(':checked'))
						{
								$('input[type=hidden][name=' + $(this).attr('name') + ']').val("1");
						}
						else
						{
								$('input[type=hidden][name=' + $(this).attr('name') + ']').val("0");
						}
				});
		});
		$('#icon_table input[type=checkbox]').click(function(){
							if ($(this).is(':checked'))
							{
									$('input[type=hidden][name=' + $(this).attr('name') + ']').val("1");
							}
							else
							{
									$('input[type=hidden][name=' + $(this).attr('name') + ']').val("0");
							}
		});


					$('#resize_avatars-save_icon_data').click(function() {
							var master_h = $('input[name=master_h]').val(),
									master_w = $('input[name=master_w]').val(),
									master_square = $('input[name=master_square]').val(),
									master_upscale = $('input[name=master_upscale]').val(),
									large_h = $('input[name=large_h]').val(),
									large_w = $('input[name=large_w]').val(),
									large_square = $('input[name=large_square]').val(),
									large_upscale = $('input[name=large_upscale]').val(),
									medium_h = $('input[name=medium_h]').val(),
									medium_w = $('input[name=medium_w]').val(),
									medium_square = $('input[name=medium_square]').val(),
									medium_upscale = $('input[name=medium_upscale]').val(),
									small_h = $('input[name=small_h]').val(),
									small_w = $('input[name=small_w]').val(),
									small_square = $('input[name=small_square]').val(),
									small_upscale = $('input[name=small_upscale]').val(),
									tiny_h = $('input[name=tiny_h]').val(),
									tiny_w = $('input[name=tiny_w]').val(),
									tiny_square = $('input[name=tiny_square]').val(),
									tiny_upscale = $('input[name=tiny_upscale]').val(),
									topbar_h = $('input[name=topbar_h]').val(),
									topbar_w = $('input[name=topbar_w]').val(),
									topbar_square = $('input[name=topbar_square]').val(),
									topbar_upscale = $('input[name=topbar_upscale]').val();

							elgg.action('admin/save_icon_data', {
											format: 'JSON',
											data: {master_h: master_h,
														 master_w: master_w,
														 master_square: master_square,
														 master_upscale: master_upscale,
														 large_h: large_h,
														 large_w: large_w,
														 large_square: large_square,
														 large_upscale: large_upscale,
														 medium_h: medium_h,
														 medium_w: medium_w,
														 medium_square: medium_square,
														 medium_upscale: medium_upscale,
														 small_h: small_h,
														 small_w: small_w,
														 small_square: small_square,
														 small_upscale: small_upscale,
														 tiny_h: tiny_h,
														 tiny_w: tiny_w,
														 tiny_square: tiny_square,
														 tiny_upscale: tiny_upscale,
														 topbar_h: topbar_h,
														 topbar_w: topbar_w,
														 topbar_square: topbar_square,
														 topbar_upscale: topbar_upscale},
											success: function(result) {
															// error
															if (result.status < 0) {
																			elgg.register_error(elgg.echo('resize_avatars:icon_save_fail'));
															} else {
																			elgg.system_message(elgg.echo('resize_avatars:icon_save_success'));
															}
											}
							});
		});

		$('#resize_avatars-im-test').click(function() {
		var guid = $('input[name=guid]').val();
		$("#resize_avatars-im-results").html('<div class="elgg-ajax-loader"></div>');
		elgg.action('admin/resize_avatar_thumbnail', {
		format: 'JSON',
		data: {guid: guid},
		cache: false,
		success: function(result) {
		// error
		if (result.status < 0) {
			var html = '';
		} else {
			var html = '<img class="elgg-photo elgg_avatar" src="'
				+ result.output.thumbnail_src + '" alt="' + result.output.title
				+ '" />';
		}
		$("#resize_avatars-im-results").html(html);
		}
		});
		});

					$('#resize_avatars-resize-thumbnails').click(function() {
		$("#resize_avatars-batch-results").html('<div class="elgg-ajax-loader"></div>');
		elgg.action('admin/resize_all_avatar_thumbnails', {
		cache: false,
		success: function(result) {
															$("#resize_avatars-batch-results").html(result.result_str);
		}
		});
		});

	};

	resizethumbnails_submit = function(e) {

		$("#resize_avatars-resize-thumbnails-ajax-spinner").show();
		$("#resize_avatars-resize-thumbnails-results").html('');

		$.ajax({
			type: "GET",
			url: $(this).attr('href'),
			dataType: "html",
			success: function(htmlData) {
				$("#resize_avatars-resize-thumbnails-ajax-spinner").hide();

				if (htmlData.length > 0) {
					$("#resize_avatars-resize-thumbnails-results").html(htmlData);
				}
			}
		});

		e.preventDefault();
	};

	elgg.register_hook_handler('init', 'system', resizethumbnails_init);
});
