<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 'payment_renewal','declined_payment', 'expiration','partners','social','events','follow','other'
class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['customer_id','type','content'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    // La membresía se renovó con éxito.
    // Vigente del 23/11/2020 al 23/12/2020.    
    public static function paymentRenewal($customerId, $transaction){// reconsider
        $paymentSubscription = \App\PaymentSubscription::whereSubscriptionId($transaction->payment_subscription_id)->first();
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        if($paymentSubscription){
            $from = iconv('ISO-8859-2', 'UTF-8', strftime("%d/%B/%Y", strtotime($transaction->done_date)));
            $to = iconv('ISO-8859-2', 'UTF-8', strftime("%d/%B/%Y", strtotime($paymentSubscription->getEndDate($transaction))));
            $notification = new Notification;
            $notification->type = "payment_renewal";
            $notification->customer_id = $customerId;
            $notification->content = "La membresía se renovó con éxito.\n Vigente del $from al $to";
            $notification->action_type = "fitemos";
            $notification->save();
        }
    }
    // Error al renovar la membresía.
    // Favor verificar el método de pago. Tiene 24 horas antes de que se cancele su membresía.
    public static function declinedPayment($customerId){// reconsider
        $notification = new Notification;
        $notification->type = "declined_payment";
        $notification->customer_id = $customerId;
        $notification->content = "Error al renovar la membresía.\n Favor verificar el método de pago. Tiene 24 horas antes de que se cancele su membresía.";
        $notification->action_type = "fitemos";
        $notification->save();
    }
    // La membresía expira en 14 días.
    // Haz click aquí para renovar con anticipación.
    
    // note--> this nofification is sent 14, 7, 3 and 1 day before expiration
    public static function bankExpiration($customerId, $days){
        $notification = new Notification;
        $notification->type = "expiration";
        $notification->customer_id = $customerId;
        $notification->content = "La membresía expira en $days días.\n Haz click aquí para renovar con anticipación.";
        $notification->action_type = "fitemos";
        $notification->save();
    }
    // When your referal join to fitemos. --> {name} se unió a Fitemos con tu invitación. Ahora ambos tienen 20% de descuento mensual.”
    public static function referralJoin($customerId, $action){
        $notification = new Notification;
        $notification->type = "partners";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> se unió a Fitemos con tu invitación.\n Ahora ambos tienen 20% de descuento mensual.";
        $notification->action_type = "customer";
        $notification->action_id = $action->id;
        $notification->save();
    }
    // when referall leave fitemos --> {name} se abandonó Fitemos. La tarifa de la membresía se reestablece.
    public static function referralLeave($customerId, $action){
        $notification = new Notification;
        $notification->type = "partners";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> se abandonó Fitemos.\n La tarifa de la membresía se reestablece.";
        $notification->action_type = "customer";
        $notification->action_id = $action->id;
        $notification->save();
    }
    // comment on post you own --> {name} comentó en tu publicación.
    public static function commentOnPost($customerId, $action){
        $actionId = $action->id;
        $notification = new Notification;
        $notification->type = "social";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> comentó en tu publicación.";
        $notification->action_type = "customer";
        $notification->action_id = $actionId;
        $notification->save();
    }
    // Tag on post--> {name} te etiquetó en una foto.
    public static function tagOn($customerId, $actionId, $post){
        $action = \App\Customer::find($actionId);
        $notification = new Notification;
        $notification->type = "social";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> te etiquetó en una foto.";
        $notification->action_type = "customer";
        $notification->action_id = $actionId;
        $notification->object_id = $post->id;
        $notification->object_type = "post";
        $notification->save();
    }
    // mention on post--> {name} te mencionó en una publicación.
    public static function mentionOnPost($customerId, $actionId, $post){
        $action = \App\Customer::find($actionId);
        $notification = new Notification;
        $notification->type = "social";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> te mencionó en una publicación.";
        $notification->action_type = "customer";
        $notification->action_id = $actionId;
        $notification->object_id = $post->id;
        $notification->object_type = "post";
        $notification->save();
    }
    // mention in comment --> {name} te mencionó en un comentario.
    public static function mentionOnComment($customerId, $actionId){
        $action = \App\Customer::find($actionId);
        $notification = new Notification;
        $notification->type = "social";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> te mencionó en un comentario.";
        $notification->action_type = "customer";
        $notification->action_id = $actionId;
        $notification->save();
    }
    //24 hours before event --> El vento {bold font - event name} es mañana a las {time}.
    public static function events($customerId, $datatime, $eventTitle){
        $notification = new Notification;
        $notification->type = "events";
        $notification->customer_id = $customerId;
        $notification->content = "El vento <b>$eventTitle</b> es mañana a las $datatime.";
        $notification->action_type = "fitemos";
        $notification->save();
    }
    //Sui started following you.
    public static function follow($customerId, $action){
        $notification = new Notification;
        $notification->type = "follow";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> empezó a seguirte.";
        $notification->action_type = "customer";
        $notification->action_id = $action->id;
        $notification->save();
    }
    //Sui likes your post.
    public static function likePost($customerId, $action, $post){
        $notification = new Notification;
        $notification->type = "social";
        $notification->customer_id = $customerId;
        $notification->content = "<b>".$action->first_name." ".$action->last_name."</b> le ha gustado tu publicación";
        $notification->action_type = "customer";
        $notification->action_id = $action->id;
        $notification->object_id = $post->id;
        $notification->object_type = "post";
        $notification->save();
    }
}
