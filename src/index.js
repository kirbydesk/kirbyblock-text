// Styles
import "../../kirby-pagewizard/src/css/panel.css";

// Blocks
import pwtext from "@/blocks/index.vue";

// Render
panel.plugin("kirbydesk/kirbyblock-text", {
	blocks: {
		pwtext: pwtext
  }
});
