export default (initialStatuses = []) => ({
    editModalOpen: false,
    addModalOpen: false,
    currentVehicle: { features: [] },
    imagePreview: null,
    galleryPreviews: [],

    statuses: Array.isArray(initialStatuses) ? initialStatuses.flat() : [],

    openAddModal() {
        //Reset the vehicle object to empty strings/defaults
        this.currentVehicle = {
            name: '',
            type: '',
            rating: 0,
            year: new Date().getFullYear(),
            plate_number: '',
            status: 'Available', // Sensible default
            price: '',
            capacity: '',
            fuel_type: '',
            transmission: 'Automatic',
            isInsurred: true,
            features: [] // Must be an empty array
        };

        //Reset image previews
        this.imagePreview = null;
        this.galleryPreviews = [];

        //Show the modal
        this.addModalOpen = true;

        //Refresh icons for the new modal DOM
        this.$nextTick(() => { 
            if (window.lucide) window.lucide.createIcons();
        });
    },

    openEditModal(vehicle) {
        // Create a shallow copy to prevent direct mutation of the original object
        this.currentVehicle = { ...vehicle };
        
        // Handle Image Preview
        this.imagePreview = vehicle.image ? '/storage/' + vehicle.image : null;
        this.galleryPreviews = [];

        // Handle Features array
        if (typeof vehicle.features === 'string') {
            try {
                this.currentVehicle.features = JSON.parse(vehicle.features);
            } catch(e) {
                this.currentVehicle.features = [];
            }
        } else {
            this.currentVehicle.features = Array.isArray(vehicle.features) ? [...vehicle.features] : [];
        }

        this.editModalOpen = true;

        // Refresh icons
        this.$nextTick(() => { 
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    },

    addFeature() {
        if (!Array.isArray(this.currentVehicle.features)) {
            this.currentVehicle.features = [];
        }
        this.currentVehicle.features.push('');
    },

    removeFeature(index) {
        this.currentVehicle.features.splice(index, 1);
    },

    handleGalleryChange(event) {
        const files = Array.from(event.target.files);
        files.forEach(file => {
            this.galleryPreviews.push(URL.createObjectURL(file));
        });
    }
}); 