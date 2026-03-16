<template>

    <div class="flex h-screen bg-gray-50 scroll-smooth">
    
    <!-- Sidebar -->
    
    <aside class="w-72 bg-white border-r border-gray-200 p-6 overflow-y-auto">
    
    <h2 class="text-xl font-bold mb-6">API Documentation</h2>
    
    <input
    class="w-full px-3 py-2 border rounded-md mb-6"
    placeholder="Search endpoints..."
    />
    
    <div class="space-y-6 text-sm">
    
    <div>
    <h4 class="text-xs uppercase text-gray-400 mb-2">Authentication</h4>
    
    <a href="#register" class="block text-blue-600 hover:underline">
    POST /api/register
    </a>
    
    <a href="#login" class="block text-blue-600 hover:underline">
    POST /api/login
    </a>
    
    </div>
    
    <div>
    <h4 class="text-xs uppercase text-gray-400 mb-2">Assets</h4>
    
    <a href="#create-asset" class="block text-green-600 hover:underline">
    POST /api/assets
    </a>
    
    <a href="#get-asset" class="block text-blue-600 hover:underline">
    GET /api/assets/{id}
    </a>
    
    </div>
    
    </div>
    
    </aside>
    
    <!-- Content -->
    
    <main class="flex-1 overflow-y-auto p-10">
    
    <header class="mb-10">
    
    <h1 class="text-3xl font-bold mb-2">
    Asset Inspection API
    </h1>
    
    <p class="text-gray-500">
    RESTful API built with Laravel. Includes Sanctum authentication.
    </p>
    
    </header>
    
    <!-- Base URL -->
    
    <section class="bg-white rounded-lg shadow-sm p-6 mb-8">
    
    <h2 class="text-lg font-semibold mb-3">Base URL</h2>
    
    <div class="bg-gray-100 rounded-md p-3 text-sm font-mono">
    http://localhost:8000/api
    </div>
    
    </section>
    
    <!-- Register -->
    
    <section id="register" class="bg-white rounded-lg shadow-sm p-6 mb-8">
    
    <h2 class="text-lg font-semibold mb-3">Register</h2>
    
    <p class="text-gray-500 text-sm mb-3">
    POST /api/register
    </p>
    
    <pre class="bg-gray-900 text-gray-100 p-4 rounded-md text-sm mb-4 overflow-x-auto">
    {
    "name": "John Doe",
    "email": "john@test.com",
    "password": "password123",
    "password_confirmation": "password123"
    }
    </pre>
    
    <button
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
    @click="registerExample"
    
    >
    
    Run Request </button>
    
    </section>
    
    <!-- Login -->
    
    <section id="login" class="bg-white rounded-lg shadow-sm p-6 mb-8">
    
    <h2 class="text-lg font-semibold mb-3">Login</h2>
    
    <p class="text-gray-500 text-sm mb-3">
    POST /api/login
    </p>
    
    <pre class="bg-gray-900 text-gray-100 p-4 rounded-md text-sm mb-4 overflow-x-auto">
    {
    "email": "john@test.com",
    "password": "password123"
    }
    </pre>
    
    <button
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
    @click="loginExample"
    
    >
    
    Run Request </button>
    
    </section>
    
    <!-- Create Asset -->
    
    <section id="create-asset" class="bg-white rounded-lg shadow-sm p-6 mb-8">
    
    <h2 class="text-lg font-semibold mb-3">Create Asset</h2>
    
    <p class="text-gray-500 text-sm mb-3">
    POST /api/assets
    </p>
    
    <pre class="bg-gray-900 text-gray-100 p-4 rounded-md text-sm mb-4 overflow-x-auto">
    {
    "name": "Generator A",
    "serial_number": "GEN-001",
    "status": "active"
    }
    </pre>
    
    <button
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
    @click="createAsset"
    
    >
    
    Run Request </button>
    
    </section>
    
    <!-- Get Asset -->
    
    <section id="get-asset" class="bg-white rounded-lg shadow-sm p-6 mb-8">
    
    <h2 class="text-lg font-semibold mb-3">Fetch Asset</h2>
    
    <p class="text-gray-500 text-sm mb-3">
    GET /api/assets/{id}
    </p>
    
    <button
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
    @click="fetchAsset"
    
    >
    
    Run Request </button>
    
    </section>
    
    <!-- Response -->
    
    <section class="bg-white rounded-lg shadow-sm p-6">
    
    <h2 class="text-lg font-semibold mb-3">Response</h2>
    
    <pre class="bg-gray-900 text-green-400 p-4 rounded-md text-sm overflow-x-auto">
    {{ formattedResponse }}
    </pre>
    
    </section>
    
    </main>
    
    </div>
    
    </template>
    
    <script>
    export default {
    
    data() {
    return {
    token: null,
    response: null
    }
    },
    
    computed: {
    
    formattedResponse() {
    return this.response
    ? JSON.stringify(this.response, null, 2)
    : "No response yet"
    }
    
    },
    
    methods: {
    
    async registerExample() {
    
    const res = await fetch('/api/register',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify({
    name:'John Doe',
    email:'john@test.com',
    password:'password123',
    password_confirmation:'password123'
    })
    })
    
    this.response = await res.json()
    
    },
    
    async loginExample() {
    
    const res = await fetch('/api/login',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify({
    email:'john@test.com',
    password:'password123'
    })
    })
    
    const data = await res.json()
    
    this.token = data.token
    this.response = data
    
    },
    
    async createAsset() {
    
    const res = await fetch('/api/assets',{
    method:'POST',
    headers:{
    'Content-Type':'application/json',
    'Authorization':'Bearer '+this.token
    },
    body:JSON.stringify({
    name:'Generator A',
    serial_number:'GEN-002',
    status:'active'
    })
    })
    
    this.response = await res.json()
    
    },
    
    async fetchAsset() {
    
    const res = await fetch('/api/assets/1',{
    headers:{
    'Authorization':'Bearer '+this.token
    }
    })
    
    this.response = await res.json()
    
    }
    
    }
    
    }
    </script>
    