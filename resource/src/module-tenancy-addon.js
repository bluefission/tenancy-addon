import "../../../../resource/src/js/modules/datatables";
import { Model, Reactor, ReactiveTemplate } from "../../../../resource/src/js/modules/scripts/reactive_template.js";
import Template from "../../../../resource/src/js/modules/scripts/template.js";
import PresentationModal from "../../../../resource/src/js/modules/scripts/presentation-modal.js";
import BlueFissionCrud from "../../../../resource/src/js/modules/app/bluefission-crud.js";

// Initialize CRUD API endpoints
app.api.tenant = new BlueFissionCrud('tenants');
app.api.user = new BlueFissionCrud('users');
app.api.addon = new BlueFissionCrud('addons');
app.api.schema = new BlueFissionCrud('schemas');
app.api.database = new BlueFissionCrud('databases');

app.api.tenant.count = function(callback) {
	this._transaction('tenants/count', data, 'GET', callback);
}

app.api.tenant.active.count = function(callback) {
	this._transaction('tenants/active/count', data, 'GET', callback);
}

app.api.tenant.churn = function(callback) {
	this._transaction('tenants/churn', data, 'GET', callback);
}

app.api.user.retention = function(callback) {
	this._transaction('users/retention', data, 'GET', callback);
}

app.api.user.churn = function(callback) {
	this._transaction('users/churn', data, 'GET', callback);
}

//== Class definition
var ModuleTenancyAddon = function() {
	var dataTable;
	const inputOptions = {
	  rejectOn: isNaN,
	  mutator: Number
	};

	// Define your model for Tenancy
	const model = new Model;
	model.tenant_id = new Reactor(0);
	model.name = new Reactor("");
	model.domain = new Reactor("");
	model.status = new Reactor("");

	// Define KPIs for Tenancy
	const kpi_01_name = new Reactor("Total Tenants");
	const kpi_01_value = new Reactor(0);
	const kpi_02_name = new Reactor("Active Tenants");
	const kpi_02_value = new Reactor(0);
	const kpi_03_name = new Reactor("User Retention Rate");
	const kpi_03_value = new Reactor(0);
	const kpi_04_name = new Reactor("User Churn Rate");
	const kpi_04_value = new Reactor(0);
	const kpi_05_name = new Reactor("Tenant Churn Rate");
	const kpi_05_value = new Reactor(0);

	// Assign KPIs to the app
	app.assign('kpi_01_name', kpi_01_name);
	app.assign('kpi_01_value', kpi_01_value);
	app.assign('kpi_02_name', kpi_02_name);
	app.assign('kpi_02_value', kpi_02_value);
	app.assign('kpi_03_name', kpi_03_name);
	app.assign('kpi_03_value', kpi_03_value);
	app.assign('kpi_04_name', kpi_04_name);
	app.assign('kpi_04_value', kpi_04_value);
	app.assign('kpi_05_name', kpi_05_name);
	app.assign('kpi_05_value', kpi_05_value);

	// Assign model fields to UI elements
	app.set('.tenant-id-field', model.tenant_id, 'value', inputOptions);
	app.set('.tenant-name-field', model.name, 'value');
	app.set('.tenant-domain-field', model.domain, 'value');
	app.set('.tenant-status-field', model.status, 'value');

	app.set('#tenant-id', model.tenant_id, 'value', inputOptions);
	app.set('#tenant-name', model.name, 'value');
	app.set('#tenant-domain', model.domain, 'value');
	app.set('#tenant-status', model.status, 'value');

	// Load the tenant list into a DataTable
	var loadTenantList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/tenants',
				dataSrc: 'list'
			},
			aoColumnDefs: [
				{ "bSortable": false, "aTargets": [ 3 ] }, 
				{ "bSearchable": false, "aTargets": [ 2, 3 ] }
			],
			columns: [
				{
					data: 'name',
					render: function(data, type, row) {
						return `<a href="#" class="show-btn">${data}</a>`;
					},
				},
				{ 
					data: 'domain',
					render: function (data, type, row) {
						return data;
					}
				},
				{ 
					data: 'status',
					render: function (data, type, row ) {
						return data == 1 ? `<span class="badge rounded-pill bg-success">Active</span>` : `<span class="badge rounded-pill bg-secondary">Inactive</span>`;
					}
				},
				{
					data: null,
					render: function (data, type, row ) {
						return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
						+'&nbsp;<button class="btn btn-sm btn-secondary settings-btn"><i class="fa fa-gear"></i></button>';
					}
				}
			]
		});
	};

	// Function to display tenant details
	var tenantShow = function() {
		$("#dataTable").on("click", ".show-btn", function(e) {
			e.preventDefault();
			var data = dataTable.row($(this).parents('tr')).data();
			app.api.tenant.read(data.tenant_id, function(response) {
				model.update(response.data);
				const template = new Template('#tenant-detail-display-item', model);
				template.render();
				template.swap('#tenant-details');
			});
		});
	};

	// Function to edit a tenant entry
	var tenantEdit = function() {
		$('#tenant-preview').on('click', '#tenant-edit-btn', function(e) {
			e.preventDefault();
			showEditScreen();
		});
	};

	// Function to create a new tenant entry
	var tenantNew = function() {
		$('#tenant-add-btn').on('click', function(e) {
			e.preventDefault();
			model.clear();
			showEditScreen();
		});
	};

	// Function to delete a tenant entry
	var tenantDelete = function() {
		$('#tenant-delete-btn').click(function() {
			app.api.tenant.delete(model, function(response) {
				app.ui.notice("Tenant has been deleted");
				dataTable.ajax.reload();
			});
		});
	};

	// Function to save a tenant entry
	var tenantSave = function() {
		$('.save-btn').click(function(e) {
			e.preventDefault();
			app.api.tenant.save(model, function(response) {
				if (!response.id) {
					app.ui.notice(response.status, 'error');
					return;
				}
				model.clear();
				dataTable.ajax.reload();
				app.ui.notice("Tenant has been saved");
			});
		});
	};

	// Additional utility functions
	var truncate = function(str, no_words) {
		return str.split(" ").splice(0,no_words).join(" ");
	};

	var screenHome = function() {
		$('.home-btn').click(function(e) {
			showListingScreen();
		});
	};

	var showEditScreen = function() {
		$('#tenant-listing-screen').fadeOut(200, function(e) {
			$('#tenant-edit-screen').fadeIn(200);
		});
	};

	var showListingScreen = function() {
		$('#tenant-edit-screen').fadeOut(200, function(e) {
			$('#tenant-listing-screen').fadeIn(200);
		});
	};

	var ready = function() {
		$('#tenant-edit-screen').hide();
		feather.replace();
	};

	// Main function to initiate the module
	return {
		init: function () {
			screenHome();
			loadTenantList();
			tenantShow();
			tenantNew();
			tenantEdit();
			tenantDelete();
			tenantSave();
			ready();

			$(document).ajaxStart(function() {
				$('#loadingOverlay').show();
			});

			$(document).ajaxStop(function() {
				$('#loadingOverlay').hide();
			});
		}
	};
}();

jQuery(document).ready(function() {
	ModuleTenancyAddon.init();
});

export default ModuleTenancyAddon;
