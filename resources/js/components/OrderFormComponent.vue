<template>
  <div class="card shadow-sm border-primary">
    <div class="card-body p-4">
      <h1>Закажи сейчас &#x1F371;&#x1F957;&#x1F35C;</h1>

      <div v-if="orderedSuccessfully" class="alert alert-success" role="alert">
        orderedSuccessfully
      </div>

      <form v-if="!orderedSuccessfully" @submit.prevent="formSubmit">
        <div class="form-group">
          <label for="userPhone">Телефон</label>
          <input v-model="user.phone" type="input" id="userPhone" class="form-control" />

          <ul v-if="errors" class="list-unstyled">
            <li v-for="error of errors['user.phone']" class="allert alert-danger p-1">{{ error }}</li>
          </ul>
        </div>
        <div class="form-group">
          <label for="userName">Имя</label>
          <input v-model="user.name" type="input" id="userName" class="form-control" />
          <ul v-if="errors" class="list-unstyled">
            <li v-for="error of errors['user.name']" class="allert alert-danger p-1">{{ error }}</li>
          </ul>
        </div>
        <div class="form-group">
            <label for="pricePlan">Тариф</label>
            <select v-model="order.price_plan_id" @change="handlePricePlanChange" class="form-control" id="pricePlan">
              <option disabled value="">Выберите тариф</option>
              <option v-for="priceplan in priceplans" v-bind:value="priceplan.id">
                {{ priceplan.name }} (дни доставки: {{ formatDeliveryDays(priceplan.delivery_days) }}) – {{ formatPrice(priceplan.price_pennies) }}
              </option>
            </select>
            <ul v-if="errors" class="list-unstyled">
              <li v-for="error of errors['order.price_plan_id']" class="allert alert-danger p-1">{{ error }}</li>
            </ul>
        </div>
        <div class="form-group">
            <label for="deliveryDay">День доставки</label>
            <select v-model="order.delivery_day" class="form-control" id="deliveryDay">
              <option disabled value="">Выберите день доставки</option>
              <option v-for="deliveryDay in deliveryDays" v-bind:value="deliveryDay.id">
                {{ deliveryDay.title }}
              </option>
            </select>
            <ul v-if="errors" class="list-unstyled">
              <li v-for="error of errors['order.price_plan_id']" class="allert alert-danger p-1">{{ error }}</li>
            </ul>
        </div>
        <button class="btn btn-primary btn-block">Заказать</button>
      </form>
    </div>
  </div>
</template>

<script>

export default {
  props: ["priceplans"],

  mounted() {
    console.log("Component mounted.");
    console.log(this.priceplans);
  },

  data() {
    return {
      orderedSuccessfully: false,
      user: { phone: "+79778603170", name: "Сергей" },
      order: { price_plan_id: "", delivery_day: "" },
      deliveryDays: [],
      errors: null
    };
  },

  methods: {
    formSubmit(e) {
      // const test = { user: '123432142};
      // console.log(test);
      this.errors = null;
      axios.post("/api/v1/orders", { user: this.user, order: this.order })
        .then(response => {
          // console.log(response);
          this.orderedSuccessfully = true;
        })
        .catch(e => {
          // console.log(e.response.data);
          if (e.response.status == 422) {
            this.errors = e.response.data.errors;
          }
        });
    },
    handlePricePlanChange(e) {
      const pricePlanId = e.target.value
      const pricePlan = this.priceplans.find((item) => item.id == pricePlanId);
      this.deliveryDays = pricePlan.delivery_days;
      console.log(this.deliveryDays);
    },
    formatDeliveryDays (deliveryDays) {
      const dayNumToNamePairs = { 1: 'пн', 2: 'вт', 3: 'ср', 4: 'чт', 5: 'пт', 6: 'сб', 7: 'вс'};
      const deliveryDaysShortNames = deliveryDays.map((dayNum) => dayNumToNamePairs[dayNum] );
      return deliveryDaysShortNames.join(', ');
    },
    formatPrice (pricePennies) {
      return String(Math.floor(pricePennies / 100)) + ' ₽';
    }
  }
};
</script>
