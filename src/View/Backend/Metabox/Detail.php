<div class="layartancap-container">
	<div class="border-l-4 border-primary-600 bg-grid-gray-100 bg-gray-50 option-tab-content">
		<div class="border border-black/5 px-6 py-4">
			<div class="animate__animated animate__fadeIn" style="">
				<div class="text-lg pb-4 mb-4 border-b border-gray-200">
					<?php echo esc_html__('Movie Detail', 'layartancap') ?>
				</div>
				<div class="grid grid-cols-12 gap-4 py-4 fab-option-container-">
					<div class="col-span-3 md:col-span-1 font-medium text-gray-600 pt-2">
						<label for="field_fab_setting_type">
							<?php echo esc_html__('Year', 'layartancap') ?>
						</label>
					</div>
					<div class="col-span-9 md:col-span-11">
						<input type="number"
						   id="field_option_design_template_icon"
						   name="fab_design[template][icon][class]"
						   class="border border-gray-200 py-2 px-3 text-grey-darkest w-full"
						   placeholder="Movie Year"
						   required
						>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
