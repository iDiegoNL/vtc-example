var RevolutionSlider = function () {

    return {

        //Revolution Slider - Full Width
        initRSfullWidth: function () {
		    var revapi;
	        jQuery(document).ready(function() {
	            revapi = jQuery('.tp-banner').revolution(
	            {
								delay:15000,
								startwidth:1170,
								startheight:400,
								hideThumbs:10,
								fullWidth:"off",
								fullScreen:"on",
								hideCaptionAtLimit: "",
								dottedOverlay:"twoxtwo",
								navigationStyle:"preview4",
								fullScreenOffsetContainer: ".header"
	            });
	        });
        },

        //Revolution Slider - Full Screen Offset Container
        initRSfullScreenOffset: function () {
		    var revapi;
	        jQuery(document).ready(function() {
	           revapi = jQuery('.tp-banner').revolution(
	            {
	                delay:15000,
	                startwidth:1170,
	                startheight:400,
	                hideThumbs:10,
	                fullWidth:"off",
	                fullScreen:"on",
	                hideCaptionAtLimit: "",
	                dottedOverlay:"twoxtwo",
	                navigationStyle:"preview4",
	                fullScreenOffsetContainer: ".header"
	            });
	        });
        }

    };
}();
