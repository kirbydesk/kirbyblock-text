<template>
	<div class="pwPreview" data-kirbyblock="text" @dblclick="open">

		<pwBlockinfo
			:value="$t('kirbyblock-text.name')"
			icon="text-left"
			:layout="$t('pw.field.text-' + content.textmode)"
		/>

		<div class="pwGrid">
			<div class="pwGridItem" :style="gridVars">

				<!-- Tagline -->
				<pwTagline v-if="content.toggletagline" :value="content.tagline" />

				<!-- Heading -->
				<pwHeading v-if="content.toggleheading" :value="content.heading" :data-level="content.level" />

				<!-- Textarea -->
				<pwTextarea v-if="content.textmode === 'textarea'" :value="content.texttextarea" />

				<!-- Writer -->
				<pwWriter	v-if="content.textmode === 'writer'" :value="content.textwriter" />

				<!-- Quote -->
				<pwQuote	v-if="content.textmode === 'quote'" :quote="content.textquote" :author="content.author" />

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
import pwQuote from '@/../../kirby-pagewizard/src/components/quote.vue'
import pwMarkdown from '@/../../kirby-pagewizard/src/components/markdown.vue'
import pwButtons from '@/../../kirby-pagewizard/src/components/buttons.vue'
import pwToggleLayoutTab from '@/../../kirby-pagewizard/src/mixins/toggleLayoutTab.js';
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';

export default {
	components: {
		pwBlockinfo,
		pwTagline,
		pwHeading,
		pwTextarea,
		pwWriter,
		pwQuote,
		pwMarkdown,
		pwButtons
	},
	mixins: [pwToggleLayoutTab, pwGridStyle],
}
</script>