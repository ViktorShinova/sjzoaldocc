<script>
    $LAB.setGlobalDefaults({BasePath: '/js/', CacheBust: false});
    $LAB

            .script("jquery-1.8.3.min.js").wait()
            .script("jquery-ui-1.10.0.custom.js").wait()
            .script(
            "jquery.validationEngine-en.js",
            "jquery.validationEngine.js",
            "bootstrap.js",
            "jquery.taghandler.min.js",
            "jquery.ui.slider.js",
            "jquery.carouFredSel-6.1.0-packed.js",
            "jquery.tinyscrollbar.min.js",
            "jquery.Jcrop.js",
            "jquery.form.js").wait()
            .script("site.js").wait(function() {
                jSite.start();
				@yield('page-scripts');
            });
			
</script>