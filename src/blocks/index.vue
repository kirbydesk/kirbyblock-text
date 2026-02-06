<template>
<div
	class="pwPreview"
	data-kirbyblock="text"
	@dblclick="open"
	:data-margintop="content.margintop === true ? 'true' : null"
	:data-marginbottom="content.marginbottom === true ? 'true' : null"
	>

		<pwBlockinfo
			:value="$t('kirbyblock-text.name')"
			icon="text-left"
			:layout="$t('pw.field.text-' + content.textmode)"
		/>

		<div class="pwGrid">
			<div
				class="pwGridItem"
				:style="gridVars"
				:data-paddingtop="content.paddingtop === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom === true ? 'true' : null"
				>

				<!-- Tagline -->
				<pwTagline v-if="content.toggletagline" :value="content.tagline" />

				<!-- Heading -->
				<pwHeading v-if="content.toggleheading" :value="content.heading" :data-level="content.level" />

				<!-- Textarea -->
				<pwTextarea v-if="content.textmode === 'textarea'" :value="content.texttextarea" />

				<!-- Writer -->
				<pwWriter	v-if="content.textmode === 'writer'" :value="content.textwriter" />

				<!-- Markdown -->
				<pwMarkdown	v-if="content.textmode === 'markdown'" :value="content.textmarkdown" />

				<!-- Buttons -->
				<pwButtons v-if="content.togglebuttons" :value="content.buttons" />

			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue'
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue'
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue'
import pwTextarea from '@/../../kirby-pagewizard/src/components/textarea.vue'
import pwWriter from '@/../../kirby-pagewizard/src/components/writer.vue'
import pwMarkdown from '@/../../kirby-pagewizard/src/components/markdown.vue'
import pwButtons from '@/../../kirby-pagewizard/src/components/buttons.vue'
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwToggleGridTab from '@/../../kirby-pagewizard/src/mixins/toggleGridTab.js';
import pwToggleSpacingTab from '@/../../kirby-pagewizard/src/mixins/toggleSpacingTab.js';
import pwToggleThemeTab from '@/../../kirby-pagewizard/src/mixins/toggleThemeTab.js';

export default {
	components: {
		pwBlockinfo,
		pwTagline,
		pwHeading,
		pwTextarea,
		pwWriter,
		pwMarkdown,
		pwButtons
	},
	mixins: [pwToggleGridTab, pwGridStyle, pwToggleSpacingTab, pwToggleThemeTab],
  computed: {
		toggleGrid() {
			if (!this.content) return undefined;
			return this.content.togglegrid;
		}
  }
}
</script>