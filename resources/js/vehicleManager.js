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

    vehicleId() {
        return this.currentVehicle?.id ?? this.currentVehicle?.VehicleId ?? null;
    },

    openEditModal(vehicle) {
        // Create a shallow copy to prevent direct mutation of the original object
        this.currentVehicle = {
            ...vehicle,
            id: vehicle.id ?? vehicle.VehicleId ?? null,
        };

        // Handle Image Preview
        this.imagePreview = vehicle.image_url || null;
        this.galleryPreviews = [];

        //Features array
        if (typeof vehicle.features === 'string') {
            try {
                this.currentVehicle.features = JSON.parse(vehicle.features);
            } catch (e) {
                this.currentVehicle.features = [];
            }
        } else {
            this.currentVehicle.features = Array.isArray(vehicle.features) ? [...vehicle.features] : [];
        }

        //Sub Images Gallery Array
        if (typeof vehicle.sub_images === 'string') {
            try {
                this.galleryPreviews = JSON.parse(vehicle.sub_images);
            } catch (e) {
                this.galleryPreviews = [];
            }
        } else {
            this.galleryPreviews = Array.isArray(vehicle.sub_images) ? [...vehicle.sub_images] : [];
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