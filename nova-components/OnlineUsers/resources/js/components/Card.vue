<template>
  <card class="mb-6">
    <div class="text-center">
      <br />
      <h1 class="text-90 font-normal mb-3">{{ users.length }} Utilisateurs en ligne</h1>
      <div class="online-users">
        <span v-for="(user, index) in users" :key="user.id">
          <a :href="'/nova/resources/users/' + user.id">{{ user.name }} {{ user.last_name }}</a><span v-if="index < users.length - 1">, </span>
        </span>
      </div>
    </div>
  </card>
</template>

<script>
export default {
  props: ['card'],

  data() {
    return {
      users: []
    };
  },

  mounted() {
    this.getOnlineUsers();
  },

  methods: {
    getOnlineUsers() {
      Nova.request()
        .get('/nova-vendor/online_users/online-users')
        .then(response => {
          this.users = response.data;
        });
    }
  }
};
</script>
<style scoped>
  .online-users a {
    margin-right: 5px;
  }
</style>