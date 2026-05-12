import './bootstrap';

import Alpine from 'alpinejs';

import vehicleManager from './vehicleManager';

window.Alpine = Alpine;

// Register the data component BEFORE starting Alpine
Alpine.data('vehicleManager', vehicleManager);

Alpine.start();