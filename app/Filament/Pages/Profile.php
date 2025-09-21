<?php

namespace App\Filament\Pages;



use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\PensionerResource\Pages;
use App\Filament\Resources\PensionerResource\RelationManagers;
use App\Models\Pensioner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class Profile extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.profile';
    protected static ?string $navigationLabel = 'Profile';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Account Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                ]),

            Forms\Components\Section::make('Password')
                ->description('Leave empty if you don’t want to change it.')
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->label('New Password')
                        ->dehydrateStateUsing(fn($state) => ! empty($state) ? Hash::make($state) : null)
                        ->dehydrated(fn($state) => filled($state))
                        ->nullable(),
                ]),
        ])->statePath('data');
    }


    public function save(): void
    {
        $user = Auth::user();
        $user->update($this->form->getState());

        Notification::make()
            ->title('Profile updated successfully!')
            ->success()
            ->send();
    }
}
