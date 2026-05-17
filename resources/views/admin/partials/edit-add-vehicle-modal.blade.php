<div x-show="addModalOpen || editModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>

    <div @click.away="addModalOpen = false; editModalOpen = false" class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">

        <div class="p-8 pb-4 flex justify-between items-center">
            <h2 class="text-2xl font-extrabold text-slate-900" x-text="vehicleId() ? 'Edit Vehicle' : 'Add New Vehicle'"></h2>
            <button @click="addModalOpen = false; editModalOpen = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <i data-lucide="x" class="w-6 h-6 text-gray-400"></i>
            </button>
        </div>

        <form :action="vehicleId() ? '{{ url('/admin/vehicles') }}/' + vehicleId() : '{{ route('admin.vehicles.store') }}'" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto p-8 pt-0 space-y-6">

            @csrf
            <template x-if="vehicleId()">
                <input type="hidden" name="_method" value="PUT">
            </template>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Vehicle Image</label>
                <div @click="$refs.mainImage.click()" class="border-2 border-dashed border-gray-100 rounded-[2rem] p-12 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-gray-50 transition-colors cursor-pointer group relative overflow-hidden min-h-[200px]">

                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="absolute inset-0 w-full h-full object-cover">
                    </template>

                    <div class="relative z-10 flex flex-col items-center" x-show="!imagePreview">
                        <div class="bg-white p-4 rounded-2xl shadow-sm mb-3 group-hover:scale-110 transition-transform">
                            <i data-lucide="image" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <p class="text-gray-400 font-bold text-sm">Click to upload image</p>
                    </div>

                    <input type="file" x-ref="mainImage" class="hidden" name="image" accept="image/*" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Make *</label>
                    <input type="text" name="make" x-model="currentVehicle.make" :placeholder="currentVehicle.id ? '' : 'e.g. Toyota'" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Model *</label>
                    <input type="text" name="model" x-model="currentVehicle.model" :placeholder="currentVehicle.id ? '' : 'e.g. Rav4'" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Category</label>
                    <select name="category" x-model="currentVehicle.category" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                        <option value="">Select category</option>
                        <option value="Five Seater">Five Seater</option>
                        <option value="Seven Seater">Seven Seater</option>
                        <option value="Double Cabin">Double Cabin</option>
                        <option value="Single Cabin">Single Cabin</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Daily Rate (UGX) *</label>
                    <input type="number" name="price_per_day" x-model="currentVehicle.price_per_day" :placeholder="currentVehicle.id ? '' : 'e.g. 150000'" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Availability Status *</label>
                    <select name="status" x-model="currentVehicle.status" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                        <option value="Available">Available</option>
                        <option value="On Rent">On Rent</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Year *</label>
                    <input x-model="currentVehicle.year" type="number" name="year" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Plate Number *</label>
                    <input x-model="currentVehicle.number_plate" type="text" name="number_plate" :placeholder="currentVehicle.id ? '' : 'e.g. UAH 123A'" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Transmission *</label>
                    <select name="transmission" x-model="currentVehicle.transmission" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Fuel Type *</label>
                    <select name="fuel_type" x-model="currentVehicle.fuel_type" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                    </select>
                </div>
            </div>

            <div class="space-y-3 pt-2">
                <div class="flex justify-between items-center">
                    <label class="text-sm font-bold text-slate-700 ml-1">Vehicle Features</label>
                    <button type="button" @click="addFeature()" class="text-xs font-bold text-slate-900 bg-gray-100 px-3 py-1.5 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-1">
                        <i data-lucide="plus" class="w-3 h-3"></i> Add New
                    </button>
                </div>
                <div class="flex flex-wrap gap-2">
                    <template x-for="(feature, index) in (currentVehicle.features || [])" :key="index">
                        <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-3 py-2 rounded-xl">
                            <input type="text" name="features[]" x-model="currentVehicle.features[index]" class="bg-transparent border-none p-0 text-xs font-bold text-slate-700 focus:ring-0 min-w-[100px]">
                            <button type="button" @click="removeFeature(index)" class="text-red-400 hover:text-red-600">
                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <div class="space-y-3 pt-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Gallery Images</label>
                <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">

                    <div @click="$refs.galleryInput.click()" class="w-24 h-24 shrink-0 border-2 border-dashed border-gray-100 rounded-2xl flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 cursor-pointer transition-all">
                        <i data-lucide="image-plus" class="w-5 h-5 text-gray-400"></i>
                        <span class="text-[9px] font-bold text-gray-400 mt-1 uppercase">Add Photo</span>
                    </div>

                    <template x-for="(url, index) in galleryPreviews" :key="index">
                        <div class="relative w-24 h-24 shrink-0 rounded-2xl overflow-hidden group shadow-sm">
                            <img :src="url.startsWith('blob:') ? url : '/storage/' + url" class="w-full h-full object-cover">

                            <button type="button" @click="galleryPreviews.splice(index, 1)" class="absolute inset-0 bg-red-500/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </template>

                    <input type="file" name="sub_images[]" x-ref="galleryInput" class="hidden" multiple @change="handleGalleryChange">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Description</label>
                <textarea name="description" x-model="currentVehicle.description" rows="3" :placeholder="currentVehicle.id ? '' : 'Describe the condition, engine, etc...'" class="w-full bg-gray-50 border-none rounded-3xl p-4 text-sm font-medium focus:ring-2 focus:ring-slate-900"></textarea>
            </div>

            <div class="flex gap-4 pt-4 sticky bottom-0 bg-white pb-2">
                <button type="button" @click="addModalOpen = false; editModalOpen = false" class="flex-1 py-4 bg-gray-50 text-slate-900 rounded-2xl font-bold hover:bg-gray-100 transition-all">
                    Cancel
                </button>
                <button type="submit" class="flex-[2] py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-xl shadow-slate-200 hover:bg-slate-800 transition-all" x-text="vehicleId() ? 'Update Vehicle' : 'Create Vehicle'">
                </button>
            </div>
        </form>
    </div>
</div>
