<template>
	<div
		class="pwPreview"
		data-kirbyblock="text"
		@dblclick="open"
		:style="colorVars"
		:data-margintop="content.margintop === true ? 'true' : null"
		:data-marginbottom="content.marginbottom === true ? 'true' : null"
		>

		<pwBlockinfo
			:value="$t('kirbyblock-text.name')"
			icon="text-left"
			:layout="$t('pw.field.text-' + editorMode)"
		/>

		<div class="pwGrid">
			<div
				class="pwGridItem"
				:style="gridVars"
				:data-paddingtop="content.paddingtop === true ? 'true' : null"
				:data-paddingright="content.paddingright === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom === true ? 'true' : null"
				:data-paddingleft="content.paddingleft === true ? 'true' : null"
				>

				<div class="contents">

					<!-- Tagline -->
					<pwTagline v-if="settings.tagline" :value="content.tagline" :alignDefault="fieldDefaults['align-tagline']" />

					<!-- Heading -->
					<pwHeading v-if="settings.heading" :value="content.heading" :data-level="content.level" :alignDefault="fieldDefaults['align-heading']" />

					<!-- Editor -->
					<pwEditor v-if="settings.editor" :content="content" :alignDefault="fieldDefaults['align-editor']" />

					<!-- Buttons -->
					<pwButtons v-if="settings.buttons" :value="content.buttons" :align="content.buttonsalignment || fieldDefaults['align-buttons']" />

				</div>
			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue'
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue'
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue'
import pwEditor from '@/../../kirby-pagewizard/src/components/editor.vue'
import pwButtons from '@/../../kirby-pagewizard/src/components/buttons.vue'
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';

export default {
	components: {
		pwBlockinfo,
		pwTagline,
		pwHeading,
		pwEditor,
		pwButtons
	},
	mixins: [pwGridStyle, pwColorStyle],
	data() {
		return {
			settings: {},
			fieldDefaults: {}
		}
	},
	computed: {
		editorMode() {
			try {
				const data = JSON.parse(this.content.editor);
				return data.mode || 'textarea';
			} catch(e) {
				return 'textarea';
			}
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwtext');
			this.settings = response.settings;
			this.fieldDefaults = response.fields || {};
		} catch (e) {
			this.settings = {};
		}
	}
}
</script>
