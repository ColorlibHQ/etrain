(function( $ , api){

    // Customizer about page redirect
    api.section( 'etrain_fof_section' , function( section ){

        section.expanded.bind( function( isExpanded ){

            if( isExpanded ){
                api.previewer.previewUrl.set( api.settings.url.home+'/maybe404page' );
            }else{
                api.previewer.previewUrl.set( api.settings.url.home );
            }
            
        } )

    } );

    // Customizer about page redirect
    api.section( 'etrain_about_section' , function( section ){

        section.expanded.bind( function( isExpanded ){

            if( isExpanded ){
                api.previewer.previewUrl.set( api.settings.url.home+customizerdata.about_page );
            }else{
                api.previewer.previewUrl.set( api.settings.url.home );
            }
            


        } )

    } );

    // Customizer blog page redirect
    api.section( 'etrain_blog_section' , function( section ){

        section.expanded.bind( function( isExpanded ){

            if( isExpanded ){
                api.previewer.previewUrl.set( customizerdata.blog_page );
            }else{
                api.previewer.previewUrl.set( api.settings.url.home );
            }
            


        } )

    } );


    // Customizer Course page redirect
    api.section( 'etrain_course_section' , function( section ){

        section.expanded.bind( function( isExpanded ){

            if( isExpanded ){
                api.previewer.previewUrl.set( api.settings.url.home+'/our-courses' );
            }else{
                api.previewer.previewUrl.set( api.settings.url.home );
            }
            


        } )

    } );

    // Customizer contact page redirect
    api.section( 'etrain_contact_section' , function( section ){

        section.expanded.bind( function( isExpanded ){

            // Customizer contact form seclector 
            var customshortcodefield = $('#customize-control-etrain_contact_custom_formshortcode'),
                selector = $('#_customize-input-etrain_contact_formshortcode');

                if( selector.val() != 'cs' ){
                    customshortcodefield.hide();
                }


            // redirect url
            if( isExpanded ){

                api.previewer.previewUrl.set( api.settings.url.home+customizerdata.contact_page );
            }else{
                api.previewer.previewUrl.set( api.settings.url.home );
            }
            

            // Contact form select change event
            selector.on( 'change', function(){

                if( $(this).val() !== 'cs' ){
                    
                    customshortcodefield.hide();
                }else{
                    customshortcodefield.show();
                     
                }
                
            } );


        } );


    } );

    // General section
    api.section( 'etrain_general_section' , function( section ){

        section.expanded.bind( function( isExpanded ){


            // Preloader option show/hide

            var $preloader      = $('#etrain_preloader_toggle'),
                $preloaderbg    = $( '#customize-control-etrain_preloader_bg_color' ),
                $preloadercolor = $( '#customize-control-etrain_preloader_color' );


            // Default

            if( $preloader.is( ':checked' ) ){
                $preloaderbg.show('slow');
                $preloadercolor.show('slow');
            }else{
                $preloaderbg.hide('slow');
                $preloadercolor.hide('slow');
            }


            // on click
            $preloader.on( 'click',  function(){

                var $this =  $( this );

                if( $this.is(':checked') ){
                    $preloaderbg.show('slow');
                    $preloadercolor.show('slow');
                }else{
                    $preloaderbg.hide('slow');
                    $preloadercolor.hide('slow');
                }


            } ); 

            // Back to top option show/hide

            var $backtotop          = $( '#etrain_backtotop_btn' ),
                $backtotopbg        = $( '#customize-control-etrain_backtotop_btn_bg_color' ),
                $backtotophoverbg   = $( '#customize-control-etrain_backtotop_btn_hover_bg_color' );

            // Default 
            if( $backtotop.is(':checked') ){
                $backtotopbg.show('slow');
                $backtotophoverbg.show('slow');
            }else{
                $backtotopbg.hide('slow');
                $backtotophoverbg.hide('slow');
            }
            // On click event
            $backtotop.on( 'click',  function(){

                var $this =  $( this );

                if( $this.is(':checked') ){
                    $backtotopbg.show('slow');
                    $backtotophoverbg.show('slow');
                }else{
                    $backtotopbg.hide('slow');
                    $backtotophoverbg.hide('slow');
                }


            } );     



        } );


    } );

    

    // Footer section
    api.section( 'etrain_footer_section' , function( section ){
        
        section.expanded.bind( function( isExpanded ){


            // Footer widget show/hide

            var $widget_toggle             = $('#etrain_footer_widget_toggle');
            var $footer_bg_color           = $('#customize-control-etrain_footer_bg_color');
            var $footer_txt_color          = $('#customize-control-etrain_footer_widget_text_color');
            var $footer_title_color        = $('#customize-control-etrain_footer_widget_title_color');
            var $footer_anc_color          = $('#customize-control-etrain_footer_widget_anchor_color');
            var $footer_anc_hover_color    = $('#customize-control-etrain_footer_widget_anchor_hover_color');


            // Default

            if( $widget_toggle.is( ':checked' ) ){
                $widget_toggle.show('fast');
                $footer_bg_color.show('fast');
                $footer_txt_color.show('fast');
                $footer_title_color.show('fast');
                $footer_anc_color.show('fast');
                $footer_anc_hover_color.show('fast');
            }else{
                $widget_toggle.hide('fast');
                $footer_bg_color.hide('fast');
                $footer_txt_color.hide('fast');
                $footer_title_color.hide('fast');
                $footer_anc_color.hide('fast');
                $footer_anc_hover_color.hide('fast');
            }

            // on click
            $widget_toggle.on( 'click',  function(){

                var $this =  $( this );

                if( $this.is(':checked') ){
                    $widget_toggle.show('fast');
                    $footer_bg_color.show('fast');
                    $footer_txt_color.show('fast');
                    $footer_title_color.show('fast');
                    $footer_anc_color.show('fast');
                    $footer_anc_hover_color.show('fast');
                }else{
                    $widget_toggle.hide('fast');
                    $footer_bg_color.hide('fast');
                    $footer_txt_color.hide('fast');
                    $footer_title_color.hide('fast');
                    $footer_anc_color.hide('fast');
                    $footer_anc_hover_color.hide('fast');
                }


            } ); 


        } );


    } );

    

})( jQuery, wp.customize );