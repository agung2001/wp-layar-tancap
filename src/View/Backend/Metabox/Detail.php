<div class="layartancap-container">
	<div class="border-l-4 border-primary-600 bg-grid-gray-100 bg-gray-50 option-tab-content">
		<div class="border border-black/5 px-6 py-4">
			<div class="animate__animated animate__fadeIn">
				<div class="grid grid-cols-12 gap-4 py-4 fab-option-container-">
					<div class="col-span-3 md:col-span-1 font-medium text-gray-600 pt-2">
						<label for="field_option_detail_description">
							<?php echo esc_html__('Description', 'layartancap') ?>
						</label>
					</div>
					<div class="col-span-9 md:col-span-11">
						<textarea
							id="field_option_detail_description"
							name="metabox_detail_description" rows="3"
							class="border border-gray-200 py-2 px-3 text-grey-darkest w-full"
						><?php echo esc_html__($description) ?></textarea>
					</div>
				</div>
				<div class="grid grid-cols-12 gap-4 py-4 fab-option-container-">
					<div class="col-span-3 md:col-span-1 font-medium text-gray-600 pt-2">
						<label for="field_option_detail_year">
							<?php echo esc_html__('Year', 'layartancap') ?>
						</label>
					</div>
					<div class="col-span-9 md:col-span-11">
						<input type="number"
						   id="field_option_detail_year"
						   name="metabox_detail_year"
						   class="border border-gray-200 py-2 px-3 text-grey-darkest w-full"
						   value="<?php echo esc_attr( $year ) ?>"
						   placeholder="Movie Year"
						>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
