@include('dashboard.components.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    @include('dashboard.components.sidebar')

    <!-- strat content -->
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="grid grid-cols-2 gap-2">
            <div class="md:py-8 py-5 md:px-16 px-5 dark:bg-gray-700 bg-white rounded shadow">
            <div class="flex justify-between items-center p-4 mb-6 bg-blue-50">
                <h1 class="text-2xl font-bold">Upcoming Events</h1>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"  onclick="document.getElementById('modal').classList.remove('hidden')">
                    + Create New Event
                </button>
            </div>
                <div class="px-4">
                    <div class="border-b pb-4 border-gray-400 border-dashed">
                        <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">9:00 AM</p>
                        <a tabindex="0" class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">Zoom call with design team</a>
                        <p class="text-sm pt-2 leading-4 leading-none text-gray-600 dark:text-gray-300">Discussion on UX sprint and Wireframe review</p>
                    </div>
                    <div class="border-b pb-4 border-gray-400 border-dashed pt-5">
                        <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">10:00 AM</p>
                        <a tabindex="0" class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">Orientation session with new hires</a>
                    </div>
                    <div class="border-b pb-4 border-gray-400 border-dashed pt-5">
                        <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">9:00 AM</p>
                        <a tabindex="0" class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">Zoom call with design team</a>
                        <p class="text-sm pt-2 leading-4 leading-none text-gray-600 dark:text-gray-300">Discussion on UX sprint and Wireframe review</p>
                    </div>
                </div>
            </div>

            <div class="calendar w-full bg-white rounded shadow md:py-8 py-5 md:px-16 px-5">
                <!-- Calendar Header -->
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xl font-semibold" id="month-picker">February</span>
                    <div class="flex items-center">
                        <span id="prev-year" class="cursor-pointer text-lg mx-2">&lt;</span>
                        <span id="year" class="text-lg font-bold">2021</span>
                        <span id="next-year" class="cursor-pointer text-lg mx-2">&gt;</span>
                    </div>
                </div>

                <!-- Calendar Body -->
                <div>
                    <!-- Week Days -->
                    <div class="grid grid-cols-7 text-center font-bold mb-2">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <!-- Days Placeholder -->
                    <div class="grid grid-cols-7 gap-1 calendar-days">
                    </div>
                </div>
                <!-- Month List Placeholder -->
                <div class="month-list mt-4"></div>
            </div>
        </div>
    </div>
    <!-- end content -->
</div>
<!-- end wrapper -->

<script>
    let calendar = document.querySelector('.calendar')
    const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

    isLeapYear = (year) => {
        return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 === 0)
    }

    getFebDays = (year) => {
        return isLeapYear(year) ? 29 : 28
    }

    generateCalendar = (month, year) => {
        let calendar_days = calendar.querySelector('.calendar-days')
        let calendar_header_year = calendar.querySelector('#year')
        let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
        calendar_days.innerHTML = ''
        let currDate = new Date()
        if (!month) month = currDate.getMonth()
        if (!year) year = currDate.getFullYear()

        let curr_month = `${month_names[month]}`
        month_picker.innerHTML = curr_month
        calendar_header_year.innerHTML = year

        let first_day = new Date(year, month, 1)

        for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
            let day = document.createElement('div')
            if (i >= first_day.getDay()) {
                day.classList.add('calendar-day-hover')
                day.innerHTML = i - first_day.getDay() + 1
                day.innerHTML += `<span></span>
                            <span></span>
                            <span></span>
                            <span></span>`
                if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                    day.classList.add('curr-date')
                }
            }
            calendar_days.appendChild(day)
        }
    }

    let month_list = calendar.querySelector('.month-list')

    month_names.forEach((e, index) => {
        let month = document.createElement('div')
        month.innerHTML = `<div data-month="${index}">${e}</div>`
        month.querySelector('div').onclick = () => {
            month_list.classList.remove('show')
            curr_month.value = index
            generateCalendar(index, curr_year.value)
        }
        month_list.appendChild(month)
    })

    let month_picker = calendar.querySelector('#month-picker')

    month_picker.onclick = () => {
        month_list.classList.add('show')
    }

    let currDate = new Date()

    let curr_month = {
        value: currDate.getMonth()
    }
    let curr_year = {
        value: currDate.getFullYear()
    }

    generateCalendar(curr_month.value, curr_year.value)

    document.querySelector('#prev-year').onclick = () => {
        --curr_year.value
        generateCalendar(curr_month.value, curr_year.value)
    }

    document.querySelector('#next-year').onclick = () => {
        ++curr_year.value
        generateCalendar(curr_month.value, curr_year.value)
    }

    let dark_mode_toggle = document.querySelector('.dark-mode-switch')

    dark_mode_toggle.onclick = () => {
        document.querySelector('body').classList.toggle('light')
        document.querySelector('body').classList.toggle('dark')
    }
</script>

@include('dashboard.components.footer')