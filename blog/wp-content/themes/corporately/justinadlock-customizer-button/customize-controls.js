( function( api ) {

	// Extends our custom "corporately" section.
	api.sectionConstructor['corporately'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
