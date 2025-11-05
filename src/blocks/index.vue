<template>
	<div class="pwPreview" data-kirbyblock="text" @dblclick="open">

		<!-- Blockinfo -->
		<Blockinfo
			:value="$t('kirbyblock-text.name')"
			icon="text-left"
			:layout="$t('pw.field.text-' + content.textmode)"
		/>

		<!-- Tagline -->
		<Tagline v-if="content.toggletagline === 'enabled'" :value="content.tagline" />

		<!-- Heading -->
		<Heading v-if="content.toggleheading === 'enabled'" :value="content.heading" :data-level="content.level" />

		<!-- Plaintext -->
		<Plain	v-if="content.textmode === 'textarea'" :value="content.texttextarea" />

		<!-- Writer -->
		<Writer	v-if="content.textmode === 'writer'" :value="content.textwriter" />

		<!-- Quote -->
		<Quote	v-if="content.textmode === 'quote'" :quote="content.textquote" :author="content.author" />

		<!-- Markdown -->
		<Markdown	v-if="content.textmode === 'markdown'" :value="content.textmarkdown" />

		<!-- Buttons -->
		<Buttons v-if="content.togglebuttons === 'enabled'" :value="content.buttons" />

	</div>
</template>

<script>
import Blockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue'
import Tagline from '@/../../kirby-pagewizard/src/components/tagline.vue'
import Heading from '@/../../kirby-pagewizard/src/components/heading.vue'
import Plain from '@/../../kirby-pagewizard/src/components/textarea.vue'
import Writer from '@/../../kirby-pagewizard/src/components/writer.vue'
import Quote from '@/../../kirby-pagewizard/src/components/quote.vue'
import Markdown from '@/../../kirby-pagewizard/src/components/markdown.vue'
import Buttons from '@/../../kirby-pagewizard/src/components/buttons.vue'

export default {
	components: {
		Blockinfo,
		Tagline,
		Heading,
		Plain,
		Writer,
		Quote,
		Markdown,
		Buttons
	}
}
</script>