@php
use App\Models\User;
@endphp


<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>


            <!--////////////////////////////////////////////////////-->

            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" />
                <select id="role" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="role" name="role" required>
                    <option>Select</option>
                     @foreach (User::getAvailableRoles() as $value => $label)
                     <option value="{{ $value }}">{{ $label }}</option>
                     @endforeach
                </select>
            </div>

            <br>

            <div id="student-fields" style="display: none;">
                <div>
                    <x-label for="category1" value="{{ __('Category') }}" />
                    <select id="category1" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="category1" name="category1" required>
                    <option>...</option>
                         @foreach (User::getStudentCategories() as $value => $label)
                         <option value="{{ $value }}">{{ $label }}</option>
                         @endforeach
                    </select>            
                </div>

                <div id="degree-student-fields" style="display: none;">
                    <div class="mt-4">
                        <x-label for="degree" value="{{ __('Degree') }}" />
                        <select id="degree" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="degree" name="degree" required>
                        <option>...</option>
                             @foreach (User::getDegrees() as $value => $label)
                             <option value="{{ $value }}">{{ $label }}</option>
                             @endforeach
                        </select>
                    </div>
    
                    <div class="mt-4">
                        <x-label for="year" value="{{ __('Year') }}" />
                        <select id="year" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="year" name="year" required>
                        <option>...</option>
                             @foreach (User::getYears() as $value => $label)
                             <option value="{{ $value }}">{{ $label }}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
                
            </div>
            
            <div id="staff-fields" style="display: none;">
                <div>
                    <x-label for="category" value="{{ __('Category') }}" />
                    <select id="category" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="category" name="category" required>
                    <option>...</option>
                         @foreach (User::getStaffCategories() as $value => $label)
                         <option value="{{ $value }}">{{ $label }}</option>
                         @endforeach
                    </select>            
                </div>

                <div id="non-other-staff-fields" style="display: none;" class="mt-4">
                    <x-label for="degree" value="{{ __('Degree') }}" />
                    <select id="degree" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="degree" name="degree" required>
                    <option>...</option>
                         @foreach (User::getDegrees() as $value => $label)
                         <option value="{{ $value }}">{{ $label }}</option>
                         @endforeach
                    </select>
                </div>
            </div>

            <!--////////////////////////////////////////////////////-->

            @if (! isset($disableTerms) || ! $disableTerms)  @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
        
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
            @endif



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button  class="ms-4">
                    <a href="/">
                    {{ __('Register') }}
                    </a>
                    
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>



<!--////////////////////////////////////////////////////-->

<script>

document.getElementById('role').addEventListener('change', function() {
  const role = this.value;
  const studentFields = document.getElementById('student-fields');
  const staffFields = document.getElementById('staff-fields');
  const degreeStudentsFields = document.getElementById('degree-student-fields');
  const nonOtherStaffFields = document.getElementById('non-other-staff-fields');

  if (role === 'USER') {
    studentFields.style.display = 'block';
    staffFields.style.display = 'none';
    degreeStudentsFields.style.display = 'none'; // Initially hide degree fields
  } else if(role === 'STAFF'){
    studentFields.style.display = 'none';
    staffFields.style.display = 'block';
    degreeStudentsFields.style.display = 'none'; // Initially hide degree fields
  }else {
    studentFields.style.display = 'none';
    staffFields.style.display = 'none';
    nonOtherStaffFields.style.display = 'none'; // hide everything else for alumni
  }

  // Add event listener for category selection
  document.getElementById('category1').addEventListener('change', function() {
    const category1 = this.value;
    console.log("Selected Category1:", category1)
    if (category1 === 'DEGREE') {
        degreeStudentsFields.style.display = 'block'; // Show degree fields for students
    } else {
      degreeStudentsFields.style.display = 'none'; // Hide degree fields
    }
  });

  document.getElementById('category').addEventListener('change', function() {
    const category = this.value;
    console.log("Selected Category:", category)
    if (category !== 'OTHER') {
        nonOtherStaffFields.style.display = 'block'; // Show degree fields for staff
    } else {
        nonOtherStaffFields.style.display = 'none'; // Hide degree fields
    }
  });
});

</script>

