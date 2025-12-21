<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // ============================================
    // ROLE MANAGEMENT FUNCTIONS (Untuk admin/user)
    // ============================================
    
    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Scope for admin users
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for regular users
     */
    public function scopeUser($query)
    {
        return $query->where('role', 'user');
    }

    /**
     * Get role label (Untuk tampilan)
     */
    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'user' => 'Pengguna',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Get role badge class (Untuk warna badge)
     */
    public function getRoleBadgeClassAttribute(): string
    {
        return match($this->role) {
            'admin' => 'badge bg-danger',
            'user' => 'badge bg-primary',
            default => 'badge bg-secondary'
        };
    }
    
    // ============================================
    // CART FUNCTIONS (Untuk shopping cart)
    // ============================================
    
    /**
     * Get user's cart items (Relationship ke CartItem)
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get total items in cart (Untuk badge di navbar)
     */
    public function cartCount(): int
    {
        return $this->cartItems()->sum('quantity');
    }

    /**
     * Check if product is already in user's cart
     */
    public function hasInCart($product_id): bool
    {
        return $this->cartItems()->where('product_id', $product_id)->exists();
    }

    /**
     * Get cart total price (Untuk checkout)
     */
    public function cartTotal(): float
    {
        $total = 0;
        $items = $this->cartItems()->with('product')->get();
        
        foreach ($items as $item) {
            $total += $item->product->price * $item->quantity;
        }
        
        return $total;
    }

    /**
     * Get formatted cart total (Rp 99.000)
     */
    public function cartTotalFormatted(): string
    {
        return 'Rp ' . number_format($this->cartTotal(), 0, ',', '.');
    }

    /**
     * Get or create cart item for product
     */
    public function getCartItem($product_id)
    {
        return $this->cartItems()->where('product_id', $product_id)->first();
    }
    
    // ============================================
    // HELPER FUNCTIONS (Untuk berbagai keperluan)
    // ============================================
    
    /**
     * Get user's display name (Bisa dipakai untuk greeting)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: explode('@', $this->email)[0];
    }

    /**
     * Check if user can access admin area
     */
    public function canAccessAdmin(): bool
    {
        return $this->isAdmin() && $this->is_active; // Jika ada kolom is_active
    }


    
}