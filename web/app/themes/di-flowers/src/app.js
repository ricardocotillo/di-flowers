import AirDatepicker from 'air-datepicker'
import localeEs from 'air-datepicker/locale/es';
import { addDays } from 'date-fns'
import Alpine from 'alpinejs'

import 'air-datepicker/air-datepicker.css';

window.Alpine = Alpine

Alpine.start()

window.onload = () => {
  const dfInput = document.querySelector('.df-datepicker input')
  if (dfInput) {
    const d = new Date()
    const startDate = addDays(d, 2)
    const airdatepicker = new AirDatepicker(`#${dfInput.id}`, {
      locale: localeEs,
      startDate,
      minDate: startDate,
      selectedDates: [startDate]
    })
  }
}