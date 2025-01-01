@extends('layouts.admin.master')

@section('content')
<div class="mt-[12px] mb-[24px] flex justify-between items-center">
    <form method="GET" onchange="filterByDate(this)" class="text-center">
        <input type="date" name="startDate" id="startDate" value="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $startDate)->format('Y-m-d') }}" class="w-5/12 md:w-auto border border-[#2E3190] rounded-[10px] px-[10px] py-[5px] mr-[10px]">
        <input type="date" name="endDate" id="endDate" value="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $endDate)->format('Y-m-d') }}" class="w-5/12 md:w-auto  border border-[#2E3190] rounded-[10px] px-[10px] py-[5px] mr-[10px]">
    </form>
<!--     <div class=" ">
        <a href="#" class="text-white bg-[#2E3190] text-[24px] text-center font-normal leading-[52px] px-[48px] py-[6px] rounded-[10px]">+ Jadwal</a>
    </div> -->
</div>
<div class="bg-white h-full border overflow-auto">
    <div id="dp"></div>
</div>
@endsection
@push('bottom-script')
<script>
    const dp = new DayPilot.Calendar("dp", {
        viewType: "Resources",
        cellDuration: 60,
        onEventResized: async (args) => {
            var data = {
                name: args.e.text(),
                jam_mulai: args.newStart.getHours().toString().padStart(2, '0') + ":" + args.newStart.getMinutes().toString().padStart(2, '0') + ":" + args.newStart.getSeconds().toString().padStart(2, '0'),
                jam_selesai: args.newEnd.getHours().toString().padStart(2, '0') + ":" + args.newEnd.getMinutes().toString().padStart(2, '0') + ":" + args.newEnd.getSeconds().toString().padStart(2, '0'),
                tanggal: args.newResource
            };
            var bookingId = args.e.id(); // Get the booking ID dynamically
            var url = "{{ route('api.booking.update', ['id' => ':id']) }}".replace(':id', bookingId);

            var response = await fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });
            if(response.status == 200){
               //toast success
               toastr.success("Data berhasil diubah");
               dp.events.update(args.e);
            }else{
                //toast error
                toastr.error("Data gagal diubah");
            }
        },
        
        timeRangeSelectedHandling: "Enabled",
        onTimeRangeSelected: async (args) => {
            const modal = await DayPilot.Modal.prompt("Tambahkan nama pembooking:", "Event 1");
            const calendar = args.control;
            console.log(args.resource);
            calendar.clearSelection();
            if (modal.canceled) {
                return;
            }

            //convert args.start to only Hour, Minute, Second must be 2 digit
            var jam_mulai = args.start.getHours().toString().padStart(2, '0') + ":" + args.start.getMinutes().toString().padStart(2, '0') + ":" + args.start.getSeconds().toString().padStart(2, '0');
            var jam_selesai = args.end.getHours().toString().padStart(2, '0') + ":" + args.end.getMinutes().toString().padStart(2, '0') + ":" + args.end.getSeconds().toString().padStart(2, '0');

            var data = {
                jam_mulai: jam_mulai,
                jam_selesai: jam_selesai,
                name: modal.result,
                tanggal: args.resource
            };
            var response = await fetch("{{ route('api.booking.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });
            var data = await response.json();
            console.log(data);
            if (data.status == 200) {
                calendar.events.add({
                    start: args.start,
                    end: args.end,
                    id: data.data.id,
                    text: modal.result,
                    resource: args.resource // Corrected resource ID
                });
                //toast success
                toastr.success("Data berhasil ditambahkan");
            } else {
                //toast error
                toastr.error("Data gagal ditambahkan");
            }


        },
        eventResizeHandling: "Update",

        eventMoveHandling: "Update",
        onEventMoved: async (args) => {
            var data = {
                name: args.e.text(),
                jam_mulai: args.newStart.getHours().toString().padStart(2, '0') + ":" + args.newStart.getMinutes().toString().padStart(2, '0') + ":" + args.newStart.getSeconds().toString().padStart(2, '0'),
                jam_selesai: args.newEnd.getHours().toString().padStart(2, '0') + ":" + args.newEnd.getMinutes().toString().padStart(2, '0') + ":" + args.newEnd.getSeconds().toString().padStart(2, '0'),
                tanggal: args.newResource
            };
            var bookingId = args.e.id(); // Get the booking ID dynamically
            console.log(bookingId);
            var url = "{{ route('api.booking.update', ['id' => ':id']) }}".replace(':id', bookingId);

            var response = await fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });
            if(response.status == 200){
               //toast success
               toastr.success("Data berhasil diubah");
               dp.events.update(args.e);
            }else{
                //toast error
                toastr.error("Data gagal diubah");
            }

        },
        eventClickHandling: "Update",
        onEventClicked: (args) => {
            console.log("Event clicked: " + args.e.text());
        },
        eventHoverHandling: "Disabled",

        onEventEdit: async (args) => {
            console.log(args);
            var data = {
                name: args.newText
            };
            var bookingId = args.e.id(); // Get the booking ID dynamically
            var url = "{{ route('api.booking.update', ['id' => ':id']) }}".replace(':id', bookingId);

            var response = await fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });
            if(response.status == 200){
               //toast success
               toastr.success("Data berhasil diubah");
               dp.events.update(args.e);
            }else{
                //toast error
                toastr.error("Data gagal diubah");
            }
        },
        eventDeleteHandling: "Update",
        onEventDeleted: async (args) => {
            var bookingId = args.e.id(); // Get the booking ID dynamically
            var url = "{{ route('api.booking.delete', ['id' => ':id']) }}".replace(':id', bookingId);

            var response = await fetch(url, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            });
            if(response.status == 200){
               //toast success
               toastr.success("Data berhasil dihapus");
            }else{
                //toast error
                toastr.error("Data gagal dihapus");
            }


        }
    });
    var menu1 = new DayPilot.Menu({
        items: [{
            text: "Ganti nama",
            onClick: function(args) {
                dp.events.edit(args.source);
            }
        }]
    });
    dp.contextMenu = menu1; // default menu
    dp.heightSpec = "BusinessHoursNoScroll";
    const dayList = [];
    const startDate = "{{ $startDate }}";
    const endDate = "{{ $endDate }}";

    // Parse startDate and endDate into JavaScript Date objects
    const start = new Date(startDate.split('-').reverse().join('-'));
    const end = new Date(endDate.split('-').reverse().join('-'));


    // Iterate through the date range
    for (let currentDate = new Date(start); currentDate <= end; currentDate.setDate(currentDate.getDate() + 1)) {
        const day = currentDate.getDate().toString().padStart(2, '0');
        const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        const year = currentDate.getFullYear();

        const formattedDate = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long', // Full day name (e.g., "Sabtu")
            day: 'numeric', // Day of the month
            month: 'short', // Month name (e.g., "November")
            year: 'numeric', // Full year
        }).format(currentDate);

        dayList.push({
            name: formattedDate, // Example: "Sabtu, 23 Nov 2024"
            id: `${day}-${month}-${year}` // Example: "23-11-2024"
        });
    }


    dp.columns.list = dayList;
    dp.businessBeginsHour = 6;
    dp.businessEndsHour = 24;
    dp.allowEventOverlap = false;

    var bookings = @json($bookingList);


    dp.events.list = bookings;
    dp.init();



    function filterByDate(form) {
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        const startDate = new Date(startDateInput.value);
        let endDate = new Date(endDateInput.value);

        // Ensure endDate is exactly 6 days after startDate if it exceeds the range
        const maxEndDate = new Date(startDate);
        maxEndDate.setDate(maxEndDate.getDate() + 6);

        if (endDate > maxEndDate) {
            endDate = maxEndDate;
            endDateInput.value = endDate.toISOString().slice(0, 10);
        }

        form.submit();
    }

    // Function to update min and max for endDate dynamically based on startDate
    function updateEndDateConstraints() {
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        const startDate = new Date(startDateInput.value);

        // Set min for endDate as startDate
        const minEndDate = new Date(startDate);
        endDateInput.setAttribute('min', minEndDate.toISOString().slice(0, 10));

        // Set max for endDate (startDate + 6 days)
        const maxEndDate = new Date(startDate);
        maxEndDate.setDate(maxEndDate.getDate() + 6);
        endDateInput.setAttribute('max', maxEndDate.toISOString().slice(0, 10));

        // Adjust endDate value if it's out of the new range
        const currentEndDate = new Date(endDateInput.value);
        if (currentEndDate > maxEndDate || currentEndDate < minEndDate) {
            endDateInput.value = maxEndDate.toISOString().slice(0, 10); // Default to maxEndDate
        }
    }

    // Attach event listener to startDate to update endDate constraints on change
    document.getElementById('startDate').addEventListener('change', updateEndDateConstraints);

    // Initialize constraints on page load
    document.addEventListener('DOMContentLoaded', () => {
        updateEndDateConstraints();
    });
</script>
@endpush