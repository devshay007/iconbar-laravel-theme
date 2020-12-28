$(function(){
  (function ($$$1) {
    var EditableTable = {

      options: {
        addButton: '#addToTable',
        save_btn: '#save_btn',
        table: '#datatableHMS',
        dialog: {
          wrapper: '#dialog',
          cancelButton: '#dialogCancel',
          confirmButton: '#dialogConfirm'
        }
      },

      initialize: function initialize() {
        this.setVars().build().events();
      },

      setVars: function setVars() {
        this.$table = $$$1(this.options.table);
        this.$addButton = $$$1(this.options.addButton);
        this.$save_btn = $$$1(this.options.save_btn);

        // dialog
        this.dialog = {};
        this.dialog.$wrapper = $$$1(this.options.dialog.wrapper);
        this.dialog.$cancel = $$$1(this.options.dialog.cancelButton);
        this.dialog.$confirm = $$$1(this.options.dialog.confirmButton);

        return this;
      },

      build: function build() {
        this.datatable = this.$table.DataTable(editable_config_opt);

        window.dt = this.datatable;

        return this;
      },

      events: function events(){
        var _self = this;
        
        this.$table.on('click', 'a.save-row', function (e) {
          e.preventDefault();

          _self.rowSave($$$1(this).closest('tr'));
        }).on('click', 'a.cancel-row', function (e) {
          e.preventDefault();

          _self.rowCancel($$$1(this).closest('tr'));
        }).on('click', 'a.edit-row', function (e) {
          e.preventDefault();

          _self.rowEdit($$$1(this).closest('tr'));
        }).on('click', 'a.remove-row', function (e) {
          e.preventDefault();

          var $row = $$$1(this).closest('tr');
          bootbox.dialog({
            message: "Are you sure that you want to delete this row?",
            title: "ARE YOU SURE?",
            buttons: {
              danger: {
                label: "Confirm",
                className: "btn-danger",
                callback: function callback() {
                  _self.rowRemove($row);
                }
              },
              main: {
                label: "Cancel",
                className: "btn-primary",
                callback: function callback() {}
              }
            }
          });
        });

        this.$addButton.on('click', function (e) {
          e.preventDefault();

          _self.rowAdd();
        });

        this.dialog.$cancel.on('click', function (e) {
          e.preventDefault();
          $$$1.magnificPopup.close();
        });

        this.$save_btn.on('click', function (e) {
          _self.saveAll();
        });

        return this;
      },

      // =============
      // ROW FUNCTIONS
      // =============
      rowAdd: function rowAdd() {
        if(checkFormValidations()==true){
          this.$addButton.attr({
            'disabled': 'disabled'
          });

          this.$save_btn.attr({
            'disabled': 'disabled'
          });

          var actions, data, $row;

          actions = ['<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row" data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>', '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row" data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>', '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit" hidden><i class="icon md-edit" aria-hidden="true"></i></a>', '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove" hidden><i class="icon md-delete" aria-hidden="true"></i></a>'].join(' ');
          data = this.datatable.row.add([rowAddColumns, actions]);
          $row = this.datatable.row(data[0]).nodes().to$();

          $row.addClass('adding').find('td:last').addClass('actions');

          this.rowEdit($row);

          this.datatable.order([0, 'asc']).draw(); // always show fields
        }
      },
      saveAll: function saveAll() {
        var tbl_data = this.datatable.column(0).data().toArray();
        callSaveRecords(tbl_data);
      },
      rowCancel: function rowCancel($row) {
        var _self = this,
            $actions,
            i,
            data,
            $cancel;
        
        this.$save_btn.removeAttr('disabled');

        if ($row.hasClass('adding')) {
          this.rowRemove($row);
        } else {
          $actions = $row.find('td.actions');
          $cancel = $actions.find('.cancel-row');
          $cancel.tooltip('hide');

          if ($actions.get(0)) {
            this.rowSetActionsDefault($row);
          }

          data = this.datatable.row($row.get(0)).data();
          this.datatable.row($row.get(0)).data(data);

          this.handleTooltip($row);

          this.datatable.draw();
        }
      },

      rowEdit: function rowEdit($row) {
        var _self = this,
            data;

        data = this.datatable.row($row.get(0)).data();

        $row.children('td').each(function (i) {
          var $this = $$$1(this);

          if ($this.hasClass('actions')) {
            _self.rowSetActionsEditing($row);
          } else {
            $this.html('<input type="text" class="form-control input-block" value="' + data[i] + '"/>');
          }
        });
      },

      rowSave: function rowSave($row) {
        var _self = this,
            $actions,
            values = [],
            $save;

        if($row.hasClass('adding')) {
          this.$addButton.removeAttr('disabled');
          $row.removeClass('adding');
          this.$save_btn.removeAttr('disabled');
        }

        values = $row.find('td').map(function () {
          var $this = $$$1(this);

          if ($this.hasClass('actions')) {
            _self.rowSetActionsDefault($row);
            return _self.datatable.cell(this).data();
          } else {
            return $$$1.trim($this.find('input').val());
          }
        });

        $actions = $row.find('td.actions');
        $save = $actions.find('.save-row');
        $save.tooltip('hide');

        if($actions.get(0)){
          this.rowSetActionsDefault($row);
        }
        this.datatable.row($row.get(0)).data(values);
        this.handleTooltip($row);

        this.datatable.draw();
      },

      rowRemove: function rowRemove($row) {
        if ($row.hasClass('adding')) {
          this.$addButton.removeAttr('disabled');
        }

        this.datatable.row($row.get(0)).remove().draw();
      },

      rowSetActionsEditing: function rowSetActionsEditing($row) {
        $row.find('.on-editing').removeAttr('hidden');
        $row.find('.on-default').attr('hidden', true);
      },

      rowSetActionsDefault: function rowSetActionsDefault($row) {
        $row.find('.on-editing').attr('hidden', true);
        $row.find('.on-default').removeAttr('hidden');
      },
      handleTooltip: function handleTooltip($row) {
        var $tooltip = $row.find('[data-toggle="tooltip"]');
        $tooltip.tooltip();
      }

    };

    $$$1(function () {
      EditableTable.initialize();
    });
  }).apply(undefined, [jQuery]);
});