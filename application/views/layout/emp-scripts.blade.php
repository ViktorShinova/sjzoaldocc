<script>
    $LAB.setGlobalDefaults({BasePath: '/js/', CacheBust: false});
    $LAB

            .script("jquery-1.8.3.min.js").wait()
            .script("jquery-ui-1.10.0.custom.js").wait()
            .script(
            "jquery.validationEngine-en.js",
            "jquery.validationEngine.js",
            "bootstrap.js",
            "jquery.form.js",
			"vendor/ckeditor/ckeditor.js",
			'jquery.easytabs.js').wait()
			@yield('LAB-script')
            .script("emp-site.js").wait(function() {
                empSite.start();
				@yield('page-scripts')
            });
</script>