@extends('layouts.frontend.account.account')

@section('content')
<div class="mx-4 bg-white shadow-lg rounded-lg overflow-hidden">
  <div class="relative w-full">
    <img src="https://picsum.photos/1500/352" alt="" />
    <div
      class="w-full absolute bottom-0 left-0 z-10 transform translate-y-3/4 lg:w-auto lg:translate-x-1/2 flex justify-center"
    >
      <img src="https://picsum.photos/160/160" alt="" />
    </div>
  </div>

  <div class="bg-gray-100 pt-[120px] lg:pt-0 lg:pl-[240px] min-h-[120px]">
    <div class="p-4 text-center lg:text-left">
      <h1 class="font-mock text-2xl text-gray-700 mb-2">
        Họ Tên : Nguyễn Tiến Hoàng
      </h1>
      <h2 class="font-mock text-gray-500">Gói Vip</h2>
      <h2 class="font-mock text-gray-500">Ngày Hết Hạn : 30/12/2023</h2>
    </div>
  </div>

  <div class="font-mock px-5 py-8 text-gray-400 ">
       <nav class="bg-gray-800">
          <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
              <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                 
                  <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
                  <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:ml-6 sm:block">
                  <div class="flex space-x-4">
                    <a href="./infoUser.html" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" >Thông tin cá nhân</a>
        
                    <a href="./lich-trinh.html" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Lịch trình tập luyện</a>
        
                  </div>
                </div>
              </div>
              
              <div class="sm:hidden" id="mobile-menu">
                  <div class="space-y-1 px-2 pt-2 pb-3">
                      <a href="./infoUser.html" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" >Thông tin cá nhân</a>
        
                      <a href="./lich-trinh.html" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Lịch trình tập luyện</a>
                  </div>
        </nav>
        <aside class="text-center mx-auto max-w-screen-xl rows">
          
          <div>
              <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">
                  <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                  <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                  </div>
              </div>
              <div class="mt-5 md:col-span-2 md:mt-0">
                  <form action="#" method="POST">
                  <div class="shadow sm:overflow-hidden sm:rounded-md">
                      <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                      <div class="grid grid-cols-3 gap-6">
                      <div>
                          <label class="block text-sm font-medium text-gray-700">Photo</label>
                          <div class="mt-1 flex items-center">
                          <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                              <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                          </span>
                          <button type="button" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
                          </div>
                      </div>
          
                      <div>
                          <label class="block text-sm font-medium text-gray-700">Cover photo</label>
                          <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                          <div class="space-y-1 text-center">
                              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              <div class="flex text-sm text-gray-600">
                              <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                  <span>Upload a file</span>
                                  <input id="file-upload" name="file-upload" type="file" class="sr-only">
                              </label>
                              <p class="pl-1">or drag and drop</p>
                              </div>
                              <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                          </div>
                          </div>
                      </div>
                      </div>
                      <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                      <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                      </div>
                  </div>
                  </form>
              </div>
              </div>
          </div>
          
          <div class="hidden sm:block" aria-hidden="true">
              <div class="py-5">
              <div class="border-t border-gray-200"></div>
              </div>
          </div>
          
          <div class="mt-10 sm:mt-0">
              <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">
                  <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                  <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                  </div>
              </div>
              <div class="mt-5 md:col-span-2 md:mt-0">
                  <form action="#" method="POST">
                  <div class="overflow-hidden shadow sm:rounded-md">
                      <div class="bg-white px-4 py-5 sm:p-6">
                      <div class="grid grid-cols-6 gap-6">
                          <div class="col-span-6 sm:col-span-3">
                          <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                          <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
          
                          <div class="col-span-6 sm:col-span-3">
                          <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                          <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
          
                          <div class="col-span-6 sm:col-span-3">
                          <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                          <input type="text" name="email-address" id="email-address" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
                          <div class="col-span-6 sm:col-span-3">
                              <label for="email-address" class="block text-sm font-medium text-gray-700">Telephone</label>
                              <input type="number" name="email-address" id="email-address" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              </div>
          
                          <div class="col-span-6 sm:col-span-3">
                          <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                          <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option>United States</option>
                              <option>Canada</option>
                              <option>Mexico</option>
                          </select>
                          </div>
          
                          <div class="col-span-6">
                          <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                          <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
          
                          <div class="col-span-4 sm:col-span-6 lg:col-span-2">
                          <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                          <input type="text" name="city" id="city" autocomplete="address-level2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
          
                          <div class="col-span-4 sm:col-span-6 lg:col-span-2">
                          <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                          <input type="text" name="region" id="region" autocomplete="address-level1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          </div>
          
                      </div>
                      </div>
                      <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                      <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                      </div>
                  </div>
                  </form>
              </div>
              </div>
          </div>
          
          <div class="hidden sm:block" aria-hidden="true">
              <div class="py-5">
              <div class="border-t border-gray-200"></div>
              </div>
          </div>
          
          </div>

          <div class="Change_passwword text-left w-full">
              <h1>Thay Đổi Mật Khẩu</h1>
              <div>
                  <label for="">Mật khẩu hiện tại (bỏ trống nếu không đổi)</label>
                  <input type="password" name="" id="">
              </div>
              <div>
                  <label for="">Mật khẩu mới (bỏ trống nếu không đổi)</label>
                  <input type="password" name="" id="">
              </div>
              <div>
                  <label for="">Xác nhận mật khẩu mới</label>
                  <input type="password" name="" id="">
              </div>
          </div>
        </aside>
  </div>
@endsection