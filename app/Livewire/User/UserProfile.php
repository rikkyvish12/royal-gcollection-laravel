<?php

namespace App\Livewire\User;

use App\Models\Profile;
use Livewire\Component;

class UserProfile extends Component
{
    public $name;
    public $dob;
    public $address;
    public $mobile_number;

    public function mount()
    {
        $profile = auth()->user()->profile;
        
        if ($profile) {
            $this->name = $profile->name;
            $this->dob = $profile->dob ? $profile->dob->format('Y-m-d') : null;
            $this->address = $profile->address;
            $this->mobile_number = $profile->mobile_number;
        }

        // Auto-fill mobile number from user account
        if (!$this->mobile_number && auth()->user()->mobile_number) {
            $this->mobile_number = auth()->user()->mobile_number;
        }
    }

    public function saveProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:1000',
        ]);

        Profile::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'name' => $this->name,
                'dob' => $this->dob,
                'address' => $this->address,
                'mobile_number' => $this->mobile_number,
            ]
        );

        session()->flash('success', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.user.user-profile')->layout('components.layouts.app');
    }
}
