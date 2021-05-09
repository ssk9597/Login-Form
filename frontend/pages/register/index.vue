<template>
  <div class="register-container">
    <form class="register-wrapper">
      <h2 class="register-title">新規登録</h2>
      <label class="register-label">
        <span class="register-label-check">必須</span>
        <span class="register-label-name">姓</span>
      </label>
      <input class="register-input" type="text" placeholder="例）田中" v-model="lastName" />
      <label class="register-label">
        <span class="register-label-check">必須</span>
        <span class="register-label-name">名</span>
      </label>
      <input class="register-input" type="text" placeholder="例）太郎" v-model="firstName" />
      <label class="register-label">
        <span class="register-label-check">必須</span>
        <span class="register-label-name">メールアドレス</span>
      </label>
      <input
        class="register-input"
        type="email"
        placeholder="例）taro@example.com"
        v-model="email"
      />
      <label class="register-label">
        <span class="register-label-check">必須</span>
        <span class="register-label-name">パスワード</span>
      </label>
      <input
        class="register-input"
        type="password"
        placeholder="例）taroTanaka"
        v-model="password"
      />
      <button class="register-button">新規登録</button>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from '@nuxtjs/composition-api';

export default defineComponent({
  setup() {
    // data
    const lastName = ref<string>('');
    const firstName = ref<string>('');
    const email = ref<string>('');
    const password = ref<string>('');

    return {
      // data
      lastName,
      firstName,
      email,
      password,
    };
  },
});
</script>

<style lang="scss" scoped>
.register {
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

  &-label {
    &-check {
      background-color: #ee4056;
      color: #fff;
      padding: 3px 10px;
      border-radius: 10%;
      font-size: 0.75rem;
      font-weight: 600;
    }
    &-name {
      font-size: 0.8rem;
      padding: 5px;
    }
  }

  &-input {
    box-sizing: border-box;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #303030;
    border: solid 1px #eee;
    border-radius: 6px;
    outline: 0;
    transition: 0.3s;
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
