import './bootstrap';

import Alpine from 'alpinejs';

import vehicleManager from './vehicleManager';

import bookingManager from './bookingManager';

window.Alpine = Alpine;

// Register the data component BEFORE starting Alpine
Alpine.data('vehicleManager', vehicleManager);
Alpine.data('bookingManager', bookingManager);

Alpine.start();