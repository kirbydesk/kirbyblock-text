// Styles
import "../../kirby-pagewizard/src/css/panel.css";
import "./css/panel.css";

// Blocks
import pwText from "@/blocks/index.vue";

// Render
panel.plugin("kirbydesk/kirbyblock-text", {
	blocks: {
		pwText: pwText
  }
});
