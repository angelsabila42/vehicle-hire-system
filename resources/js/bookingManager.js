export default () => ({
    bookingDrawerOpen: false,
    selectedBooking: {},

    openBookingDrawer(booking) {
        this.selectedBooking = booking;
        this.bookingDrawerOpen = true;
    },
    
});