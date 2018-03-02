(function($) {

  /**
   * Object definition for displaySettings.
   *
   * @param {*}
   */
  function displaySettings($parent, $element, isMaster = false) {

    function getControlValues(fields) {
      // Settings from form values.
      let settings = [];
      $.each(fields, function(i){
        let $el = $(this);
        let label = $el.attr('display-label-value');
        settings[label] = $el.prop('checked');
      });
      return settings;
    }

    function getTargetFields() {
      let fields = [];
      if (!this.isMaster) {
        let targetFields = $parent.find('[action-set-field="true"]');
        $.each(targetFields, function(){
          var $el = $(this);
          fields[$el.attr('action-set-field-label')] = $el;
        });
      }
      return fields;
    }

    // Properties
    this.id = $element.attr('id');
    this.isMaster = isMaster;
    this.controls = $element.find('[display-label-control="true"]');
    this.controlSettings = getControlValues(this.controls);
    this.targetFields = getTargetFields();

    // Methods
    this.setTargetDisplayFieldValues = function(obj) {
      var settings = this.controlSettings.duration;
      for (let prop in this.controlSettings) {
        let $target = this.targetFields[prop];
        let control = this.controlSettings[prop];
        let className = control ? 'action-set-display__visible' : 'action-set-display__hidden';
        $target.addClass(className);
      }

    }

  }

  Drupal.behaviors.praFields = {
    attach: function (context, settings) {
      let formId = 'node-workout-edit-form';
      let $form = $('#' + formId);
      let $controlField = $form.find('#edit-field-display-settings-0');
      let dS = new displaySettings($form, $controlField, true);
      // Get subform elements.
      let selector = '#edit-field-action-sets-wrapper [display-label-wrapper="true"]';
      var $dsFields = $(selector);
      var fieldSettings = [];
      $.each($dsFields, function(i){
        let $el = $(this);
        // possible to use something besides paragraphs class?
        let ds = new displaySettings($el.parents('.paragraphs-subform'), $el);
        ds.setTargetDisplayFieldValues(ds);
        fieldSettings[$el.attr('id')] = ds;
      });

      var i = 1;
      // $form.html(dsMaster.fields.length);

      // $form.html(displayValues);

    }
  };
  })(jQuery);