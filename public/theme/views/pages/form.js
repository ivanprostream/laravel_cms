/**
 * Create / Edit Page scriprs
 */

$(function () {

	/** autocomplited page category **/
	$('#parent').select2();


	/** visual text editor summernote **/
    $('#text').summernote({
        height: 200,
    })

    $('#text_2').summernote({
        height: 30,
    })


});