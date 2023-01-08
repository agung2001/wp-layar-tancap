<div id="<?php echo esc_attr( $optionTab ) ?>" class="layartancap-container">

    <div class="grid grid-cols-12">
        <div class="col-span-2">
            <?php foreach ( $this->sections as $path => $section ) : ?>
                <div class="cursor-pointer flex flex-row items-center h-12 px-4 text-gray-400 bg-gray-100 hover:bg-primary-600 hover:text-white layartancap-option-navigation <?php echo ( $section['active'] ) ? 'layartancap-current-option-navigation' : ''; ?>"
                     data-target="<?php echo esc_attr( $section['target'] ); ?>"
                     data-optiontab="<?php echo esc_attr( $optionTab ) ?>">
                    <span class="flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </span>
                    <span class="ml-3 tab-label">
                        <?php echo esc_attr( ucwords($section['name']) ); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="col-span-10 border-l-4 border-primary-600 bg-grid-gray-100 bg-gray-50 option-tab-content">
            <div class="border border-black/5 px-6 py-4">
                <?php foreach ( $this->sections as $path => $section ) : ?>
                <?php extract( $this->sectionLoopLogic( $path, $section ) ); ?>
                    <div id="<?php echo esc_attr( $section['target'] ); ?>" class="layartancap-option-content <?php echo ( $section['active'] ) ? 'layartancap-current-option' : ''; ?>">
                        <div class="text-lg pb-4 mb-4 border-b border-gray-200">
                            <?php echo esc_attr( ucwords($section['name']) ); ?>
                        </div>
                        <?php $this->loadContent( $content ); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>
<script type="text/javascript">
    jQuery('.layartancap-option-navigation').on('click', function(){
        /** Data */
        let optionTab = jQuery(this).data('optiontab');
            optionTab = jQuery(`#${ optionTab }`);

        /** Navigation */
        let activeTabClass = 'layartancap-current-option-navigation';
        jQuery('.layartancap-option-navigation', optionTab).removeClass(activeTabClass);
        jQuery(this).addClass(activeTabClass);
        let tabAnimation = `animate__animated animate__${ window.LAYARTANCAP_PLUGIN.options.layartancap_animation.elements.tab }`;
        jQuery('.tab-label', optionTab).removeClass(tabAnimation);
        jQuery(`.tab-label`, this).addClass(tabAnimation);

        /** Content */
        let tabContentAnimation =  `animate__animated animate__${ window.LAYARTANCAP_PLUGIN.options.layartancap_animation.elements.content }`;
        jQuery('.layartancap-option-content', optionTab).removeClass(tabContentAnimation).removeClass('layartancap-current-option');
        jQuery(`#${ jQuery(this).data('target') }`).addClass(tabContentAnimation).addClass('layartancap-current-option');
    });
</script>