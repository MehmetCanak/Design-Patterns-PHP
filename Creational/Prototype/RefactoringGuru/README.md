# Prototype in PHP

Prototip, nesnelerin, hatta karmaşık olanların bile, belirli sınıflarına bağlanmadan klonlanmasına izin veren yaratıcı bir tasarım modelidir.

### Kullanım örnekleri: 
- Prototip deseni kutudan çıktığı gibi PHP'de mevcuttur. Bir nesnenin tam bir kopyasını oluşturmak için klon anahtar sözcüğünü kullanabilirsiniz. Bir sınıfa klonlama desteği eklemek için bir __clone yöntemi uygulamanız gerekir. 
### Tanımlama: 
- Prototip, klonlama veya kopyalama yöntemleri vb. ile kolayca tanınabilir.

## Conceptual Example (Kavramsal Örnek)
Bu örnek, Prototip tasarım deseninin yapısını gösterir ve aşağıdaki sorulara odaklanır: 
- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? 
- Modelin öğeleri nasıl ilişkilidir? 
Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan aşağıdaki örneği kavramanız daha kolay olacaktır.

## Gerçek Dünya Örneği 

Prototip deseni, nesneleri tüm alanlarını doğrudan kopyalayarak yeniden oluşturmaya çalışmak yerine mevcut nesneleri çoğaltmanın uygun bir yolunu sağlar. Doğrudan yaklaşım sizi yalnızca klonlanan nesnelerin sınıflarıyla eşleştirmekle kalmaz, aynı zamanda özel alanların içeriğini kopyalamanıza da izin vermez. Prototip kalıbı, sınıfın özel alanlarına erişimin kısıtlanmadığı, klonlanmış sınıf bağlamında klonlamayı gerçekleştirmenizi sağlar. Bu örnek, Prototip modelini kullanarak karmaşık bir Sayfa nesnesini nasıl kopyalayacağınızı gösterir. Page sınıfı, Prototip kalıbı sayesinde klonlanan nesneye taşınacak olan çok sayıda özel alana sahiptir.

