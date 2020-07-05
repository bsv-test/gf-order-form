<template>
  <div class="card shadow-sm border-primary">
    <div class="card-body p-4">
      <h1>Закажи сейчас &#x1F371;&#x1F957;&#x1F35C;</h1>

      <div
        v-if="orderedSuccessfully"
        class="alert alert-success"
        role="alert"
      >Спасибо! Мы приняли ваш заказ!</div>

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
          <label class="d-block">Тариф</label>
          <div class="btn-group-vertical btn-group-toggle">
            <label
              @change="handlePricePlanChange"
              v-for="priceplan in priceplans"
              v-bind:class="order.price_plan_id === priceplan.id ? 'active' : ''"
              class="btn btn-outline-dark text-left"
            >
              <input type="radio" v-model="order.price_plan_id" :value="priceplan.id" />
              {{ priceplan.name }} (дни доставки: {{ priceplan.deliveryDaysPresented }}) – {{ priceplan.price }} ₽
            </label>
          </div>
          <ul v-if="errors" class="list-unstyled">
            <li v-for="error of errors['order.price_plan_id']" class="alert alert-danger p-1" >{{ error }}</li>
          </ul>
        </div>

        <div class="form-group">
          <label class="d-block">Дата первой доставки</label>
          <div class="btn-group-vertical btn-group-toggle">
            <label
              v-for="(deliveryDateLabel, deliveryDate) in deliveryDates"
              class="btn btn-outline-dark"
              v-bind:class="order.delivery_date === deliveryDate ? 'active' : ''"
            >
              <input type="radio" v-model="order.delivery_date" :value="deliveryDate" />
              {{ deliveryDateLabel }}
            </label>
          </div>
          <ul v-if="errors" class="list-unstyled">
            <li v-for="error of errors['order.delivery_date']" class="alert alert-danger p-1" >{{ error }}</li>
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
    if (this.priceplans.length) {
      this.order.price_plan_id = this.priceplans[0].id;
      this.handlePricePlanChange();
    }
  },

  data() {
    return {
      orderedSuccessfully: false,
      user: { phone: "+79778603170", name: "Сергей" },
      order: { price_plan_id: "", delivery_date: "" },
      deliveryDates: [],
      errors: null
    };
  },

  methods: {
    formSubmit(e) {
      this.errors = null;
      axios.post("/api/v1/orders", { user: this.user, order: this.order })
        .then(response => {
          this.orderedSuccessfully = true;
        })
        .catch(e => {
          if (e.response.status == 422) {
            this.errors = e.response.data.errors;
          }
        });
    },
    handlePricePlanChange() {
      const pricePlan = this.priceplans.find(item => item.id == this.order.price_plan_id);
      this.deliveryDates = pricePlan.possibleDeliveryDateOptions;
    }
  }
};
</script>
