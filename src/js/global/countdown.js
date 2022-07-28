/**
 * File countdown.js
 *
 *
 * @author Greg Rickaby, Corey Collins
 * @since January 31, 2020
 */
function wdsWindowReady() {
	const dateItems = document.querySelectorAll( '.date_item' );

	dateItems.forEach( ( dateItem ) => {
		const dataDate = dateItem.dataset.date;
		const eventDate = dataDate + ' UTC-6';

		// Set the date we're counting down to
		const countDownDate = new Date( eventDate ).getTime();

		function displayCount() {
			const now = new Date().getTime();

			// Find the distance between now and the count down date
			const distance = countDownDate - now;

			// Time calculations for days, hours, minutes and seconds
			const days = Math.floor( distance / ( 1000 * 60 * 60 * 24 ) );
			const hours = Math.floor(
				( distance % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 )
			);
			const minutes = Math.floor(
				( distance % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 )
			);
			const seconds = Math.floor( ( distance % ( 1000 * 60 ) ) / 1000 );

			// Output the result in an element with id="DateTimeInfo"
			// more than
			if ( days > 1 ) {
				dateItem.innerHTML = days + ' Days';
			} else if ( days === 1 ) {
				dateItem.innerHTML = days + ' Day and ' + hours + ' Hours ';
			} else if ( days === 0 ) {
				dateItem.innerHTML = hours + ' hrs ' + minutes + ' mins';
			} else if ( days === 0 && hours === 0 ) {
				dateItem.innerHTML = minutes + ' mins and ' + seconds;
			}

			// If the count down is over, write some text
			if ( distance < 0 ) {
				clearInterval( x );
				document.getElementById( 'DateTimeInfo' ).innerHTML = '';
			}
		}
		// init
		displayCount();

		// Update the count down every 1 second
		const x = setInterval( function () {
			displayCount();
		}, 10000 );
	} );
}

if (
	( 'complete' === document.readyState ||
		'loading' !== document.readyState ) &&
	! document.documentElement.doScroll
) {
	wdsWindowReady();
} else {
	document.addEventListener( 'DOMContentLoaded', wdsWindowReady );
}
