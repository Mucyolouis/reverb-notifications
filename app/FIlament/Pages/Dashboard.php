<?php
 
namespace App\Filament\Pages;

use App\Events\Test;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
 
class Dashboard extends \Filament\Pages\Dashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('action')
                ->label('Update Profile')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->autofocus(),
                ])

                ->action(function (array $data){
                    $user = User::find(2);


                    // Notification::make()
                    //     ->title('Saved successfully')
                    //     ->broadcast($user);
                    Notification::make()
                        ->title('Saved successfully')
                        ->seconds(10)
                        ->sendToDatabase($user);
                    
                    event(new DatabaseNotificationsSent($user));
                }),
        ];
    }
}