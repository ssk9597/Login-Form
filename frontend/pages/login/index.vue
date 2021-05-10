<template>
  <div class="login-container">
    <ValidationObserver v-slot="{ invalid }">
      <form class="login-wrapper" @submit.prevent="loginUser()">
        <h2 class="login-title">ログイン</h2>
        <div v-if="errors" class="login-alert-red">
          <p v-if="errors.name">{{ errors.name[0] }}</p>
          <p v-if="errors.email">{{ errors.email[0] }}</p>
          <p v-if="errors.password">{{ errors.password[0] }}</p>
        </div>
        <!-- メールアドレス -->
        <label class="login-label">
          <span class="login-label-name">メールアドレス</span>
        </label>
        <ValidationProvider
          class="login-input"
          name="メールアドレス"
          rules="required|email"
          v-slot="{ errors }"
        >
          <input
            class="login-input-area"
            type="email"
            placeholder="例）taro@example.com"
            v-model="email"
          />
          <p class="login-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- パスワード -->
        <label class="login-label">
          <span class="login-label-name">パスワード</span>
        </label>
        <ValidationProvider
          class="login-input"
          name="パスワード"
          rules="required|min:8|alpha_dash"
          v-slot="{ errors }"
        >
          <input
            class="login-input-area"
            type="password"
            placeholder="例）taroTanaka"
            v-model="password"
          />
          <p class="login-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- 新規追加 -->
        <button class="login-button" type="submit" :disabled="invalid">ログイン</button>
      </form>
    </ValidationObserver>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, useContext } from '@nuxtjs/composition-api';

export default defineComponent({
  setup(props, context) {
    // axios
    const { $axios } = useContext();
    // router
    const router = context.root.$router;
    // data
    const email = ref<string>('');
    const password = ref<string>('');
    const errors = ref<string>('');

    // methods
    const loginUser = async () => {
      try {
        await $axios.post('/users/login', {
          email: email.value,
          password: password.value,
        });
      } catch (err) {
        errors.value = err.response.data.errors;
        console.log(err.response.data.errors);
      }
    };

    return {
      // data
      email,
      password,
      errors,
      // methods
      loginUser,
    };
  },
});
</script>

<style lang="scss" scoped>
.login {
  &-container {
    position: relative;
    height: 100vh;
    width: 100%;
    background-color: #eeeeee;
  }

  &-wrapper {
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(-50%);
    max-width: 400px;
    width: 100%;
    background-color: #fff;
    border-radius: 10px;
    padding: 50px 50px;
  }

  &-title {
    text-align: center;
    padding-bottom: 20px;
  }

  &-alert-red {
    padding: 5px 10px;
    background: #ffebee;
    margin-bottom: 10px;
    font-size: 12px;
  }

  &-label {
    &-name {
      font-size: 0.8rem;
    }
  }

  &-input {
    padding-top: 10px;
    padding-bottom: 15px;
    display: block;

    &-area {
      box-sizing: border-box;
      width: 100%;
      padding: 10px;
      font-size: 14px;
      color: #303030;
      border: solid 1px #eee;
      border-radius: 6px;
      outline: 0;
      transition: 0.3s;
    }

    &-error {
      padding-top: 5px;
      font-size: 12px;
      color: #ee4056;
      font-weight: 600;
    }
  }

  &-button {
    margin-top: 20px;
    width: 100%;
    height: 40px;
    color: #fff;
    background: #40c7c1;
    text-decoration: none;
    border: none;
    outline: none;
    border-radius: 8px;
    cursor: pointer;
    appearance: none;
    transition: 0.2s;

    &:hover {
      background: #78cec8;
    }
  }
}
</style>
