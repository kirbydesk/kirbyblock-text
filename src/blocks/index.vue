<template>
	<div class="pwPreview" data-kirbyblock="text" @dblclick="open">

		<Blockinfo
			:value="$t('kirbyblock-text.name')"
			icon="text-left"
			:layout="$t('pw.field.text-' + content.textmode)"
		/>

		<div class="grid">
			<div :style="gridStyle" class="gridItem">

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
		</div>
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
	},
	computed: {
    gridStyle() {
      const span = Number(this.content.blockwidth) || 12;

      // If alignment is "offset", calculate the start column based on offset direction and value
      if (this.content.blockalignment === 'offset') {
        const offsetValue = Number(this.content.blockoffsetvalue) || 0;
        if (this.content.blockoffset === 'left') {
          return {
            gridColumn: `${1 + offsetValue} / span ${span}`
          };
        }
        if (this.content.blockoffset === 'right') {
          // For right offset, calculate the start column from the right side
          const start = 12 - span - offsetValue + 1;
          return {
            gridColumn: `${start} / span ${span}`
          };
        }
      }

      // If alignment is "center", center the block in the grid
      if (this.content.blockalignment === 'center') {
        // Calculate the start column so the block is centered
        const start = Math.floor((12 - span) / 2) + 1;
        return {
          gridColumn: `${start} / span ${span}`
        };
      }

      // Default: full width or just span the given columns
      return {
        gridColumn: `span ${span}`
      };
    }
  }
}
</script>
<style scoped>
.grid {
  display: block;
	padding: var(--spacing-3);
	border-radius: var(--rounded) !important;
}
@media (min-width: 960px) {
  .grid {
		display: grid;
		padding: 0;
		grid-template-columns: repeat(12, 1fr);
		background-color: var(--color-gray-250);
		gap: 1rem;

		.gridItem {
			padding: var(--spacing-3);
			background-color: light-dark(white, var(--color-red-750));

			/* TODO: border-radius: var(--rounded) !important; */
		}
	}
}
</style>