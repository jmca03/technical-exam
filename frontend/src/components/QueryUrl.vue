<template>
  <div>
    <b-container>
      <b-card class="p-3">
        <b-form-input
          class="m-3"
          v-model="url"
          placeholder="URL"
        ></b-form-input>
        <b-button variant="primary" @click="query">Query</b-button>

        <b-card>
          <pre> {{ urlResponse }} </pre>
        </b-card>

        <b-card>
          <pre> {{ reverseUrlResponse }} </pre>
        </b-card>
      </b-card>
    </b-container>
  </div>
</template>

<script setup name="QueryUrl">
import { ref } from 'vue';

// import { axios } from 'vue-axios';

const axios = require('axios');
const url = ref('');
const urlResponse = ref('');
const reverseUrlResponse = ref('');

function query() {
  axios
    .get('http://technical-exam.laravel/api/query', {
      params: {
        url: url.value,
      },
    })
    .then(function (response) {
      const getUrlResponse = response.data.url_response;
      urlResponse.value = JSON.stringify(getUrlResponse, null, 2);
      reverseUrlResponse.value = JSON.stringify(reverseUrlResponse);
    })
    .catch(function (error) {
      console.log(error);
    });
}
</script>

<style scoped>
pre {
  display: inline-block;
  text-align: left;
  max-height: 250px;
}
</style>
