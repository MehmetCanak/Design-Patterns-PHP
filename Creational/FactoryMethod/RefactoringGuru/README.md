# PHP'de Fabrika Yöntemi

### Fabrika yöntemi, somut sınıflarını belirtmeden ürün nesneleri oluşturma problemini çözen yaratıcı bir tasarım modelidir.

Fabrika Yöntemi, doğrudan yapıcı çağrısı (new operator) kullanmak yerine nesne oluşturmak için kullanılması gereken bir yöntem tanımlar. Alt sınıflar, oluşturulacak nesnelerin sınıfını değiştirmek için bu yöntemi geçersiz kılabilir.

## Kullanım örnekleri: 

Fabrika Metodu kalıbı, PHP kodunda yaygın olarak kullanılır. Kodunuz için yüksek düzeyde esneklik sağlamanız gerektiğinde çok kullanışlıdır.

## Tanımlama: 
Fabrika yöntemleri, somut sınıflardan nesneler oluşturan oluşturma yöntemleriyle tanınabilir. Nesne oluşturma sırasında somut sınıflar kullanılırken, fabrika yöntemlerinin dönüş türü genellikle soyut bir sınıf veya bir arayüz olarak bildirilir.

## Kavramsal Örnek 

Bu örnek, Fabrika Yöntemi tasarım modelinin yapısını gösterir ve aşağıdaki sorulara odaklanır: 
- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? 
- Modelin öğeleri nasıl ilişkilidir? 

Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan aşağıdaki örneği kavramanız daha kolay olacaktır.

## Gerçek Dünya Örneği 

Bu örnekte, Fabrika Yöntemi kalıbı, ağda oturum açmak, gönderiler oluşturmak ve potansiyel olarak başka etkinlikler gerçekleştirmek için kullanılabilen sosyal ağ bağlayıcıları oluşturmak için bir arabirim sağlar ve bunların tümü, müşteri kodunu belirli sınıflarla eşleştirmeden yapılır. belirli bir sosyal ağ.

