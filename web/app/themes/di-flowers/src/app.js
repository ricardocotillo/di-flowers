import AirDatepicker from 'air-datepicker'
import localeEs from 'air-datepicker/locale/es';
import { addDays } from 'date-fns'
import Alpine from 'alpinejs'

import 'air-datepicker/air-datepicker.css';

window.Alpine = Alpine

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
  Alpine.start()
  jQuery('.notice-close').click(function() {
    const parent = jQuery(this).parents('li')
    const wrapper = jQuery(this).parents('.woocommerce-error')
    const children = wrapper.children()
    if (children.length <= 1) wrapper.remove()
    else parent.remove()
  })
}