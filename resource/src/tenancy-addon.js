// Common (required)
import "../../../../resource/src/js/modules/bootstrap";

// API and Endpoints
import BlueFissionAPI from "../../../../resource/src/js/modules/app/bluefission-api.js";

// Dashboard UI (requires jQuery)
import DashboardUI from "../../../../resource/src/js/modules/dashboard-ui/dashboard-ui.js";
import "../../../../resource/src/js/modules/dashboard-ui/dashboard-form.js";
import "../../../../resource/src/js/modules/dashboard-ui/record-set.js";
import "../../../../resource/src/js/modules/dashboard-ui/dashboard-response.js";
import "../../../../resource/src/js/modules/dashboard-ui/dashboard-storage.js";
import "../../../../resource/src/js/modules/dashboard-ui/dashboard-module.js";
import "../../../../resource/src/js/modules/dashboard-ui/portlet-ui.js";
import "../../../../resource/src/js/modules/dashboard-ui/convert-colors.js";

// Framework utils
import { computed, get, set, assign } from "../../../../resource/src/js/modules/scripts/reactive_template.js";

// Panels
import HestiaPages from "./pages.js";
// import Schedule from "./schedule.js";

const Panels = {
	pages: HestiaPages,
	// schedule: Schedule,
};

const App = {
  api: BlueFissionAPI,
  ui: DashboardUI,
  get: get,
  set: set,
  assign: assign,
  computed: computed,
  panels: Panels,
};

$( document ).ready(function() {
	DashboardUI.menuClass = '#main-menu';
	DashboardUI.subMenuClass = 'sidebar-dropdown';
	DashboardUI.menuItemActiveClass = 'active';
	DashboardUI.panel = '.content';
	DashboardUI.root = 'home/';
	DashboardUI.home = 'dashboard';
	DashboardUI.moduleDir = '/modules/';
	DashboardUI.init();

	$('#logout-btn').click(function() {
		$('#logout-form').submit();
	});
});

window.app = App;
export default App;